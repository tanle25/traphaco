<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserManage\CreateUserRequest;
use App\Http\Requests\Admin\UserManage\UpdateUserRequest;
use App\Imports\UserImport;
use App\Models\Department;
use App\Models\UserPosition;
use App\User;
use Auth;
use DataTables;
use DB;
use Excel;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$users = User::paginate(10, ['*'], 'page', 15);
        return view('admin.pages.user_manage.list');
    }

    public function listUser(Request $request)
    {
        $users = User::leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('user_position', 'users.position_id', '=', 'user_position.id')
            ->select([
                'users.id',
                'users.username',
                'users.fullname',
                'users.email',
                DB::raw("CONCAT(departments.department_name,' - ',user_position.name) as department_name"),
            ]);

        // Using datatable dependency
        // Đoạn code này dùng để setup dữ liệu data table
        // Link tham khảo: https://yajrabox.com/docs/laravel-datatables/master/filter-column
        return DataTables::eloquent($users)
            ->addIndexColumn()
            ->filterColumn('department_name', function ($query, $keyword) {
                $sql = "CONCAT(departments.department_name,' - ',user_position.name) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($user) {
                return '<a data-toggle-for="tooltip" title="Sửa thông tin" href="' . route('admin.usermanage.edit', $user->id) . '"class="btn text-success"><i class="fas fa-user-edit"></i></a>
                        <a data-toggle-for="tooltip" title="Xóa" href="' . route('admin.usermanage.destroy', $user->id) . '" class="btn text-danger"><i class="far fa-trash-alt"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $departments = Department::all()->sortBy('id');
        $user_positions = UserPosition::all()->sortBy('level');

        return view('admin.pages.user_manage.create', compact('departments', 'user_positions', 'permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        // dd($request);
        $data = $request->all();
        if ($request->has('is_admin') && $data['is_admin'] == 'on') {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }
        if (!$request->has('roles')) {
            $data['roles'] = [];
        }
        if (!$request->has('permissions')) {
            $data['permissions'] = [];
        }

        $data['password'] = Hash::make($data['password']);
        // dd($data);
        // $newUser = User::create($data);
        $newUser = new User();
        $newUser ->fullname= $data['fullname'];
        $newUser ->nationality= $data['nationality'];
        $newUser ->registration_number= $data['registration_number'];
        $newUser ->date_range= $data['date_range'];
        $newUser ->place_issued= $data['place_issued'];
        $newUser ->deputy= $data['deputy'];
        $newUser ->document_number= $data['document_number'];
        $newUser ->address= $data['address'];
        $newUser ->number_share= $data['number_share'];
        $newUser ->username= $data['username'];
        $newUser ->email= $data['email'];
        $newUser ->password= $data['password'];
        $newUser ->department_id= $data['department_id'];
        $newUser ->position_id= $data['position_id'];
        $newUser ->is_admin= $data['is_admin'];
        $newUser->save();
        foreach ($data['roles'] as $role) {
            $newUser->assignRole($role);
        }

        foreach ($data['permissions'] as $permission) {
            $newUser->givePermissionTo($permission);
        }
        return redirect()->route('admin.usermanage.index')->with(['success' => 'Tạo user mới thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $user = User::findOrFail($id);
        $departments = Department::all()->sortBy('id');
        $user_positions = UserPosition::all()->sortBy('level');
        $permissions_via_role = $user->getPermissionsViaRoles()->pluck('id')->toArray();

        $permissions = $permissions->filter(function ($item) use ($permissions_via_role) {
            return !in_array($item->id, $permissions_via_role);
        });

        return view('admin.pages.user_manage.edit', compact('departments', 'user_positions', 'user', 'permissions', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();

        if (!$request->has('roles')) {
            $data['roles'] = [];
        }
        if (!$request->has('permissions')) {
            $data['permissions'] = [];
        }

        if ($request->has('is_admin') && $data['is_admin'] == 'on') {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }

        if ($request->has('password')) {
            if ($request->password == null) {
                $data['password'] = $user->password;
            } else {
                $data['password'] = Hash::make($data['password']);
            }
        }

$user->fullname = $data['fullname'];
        $user->nationality = $data['nationality'];
        $user->registration_number = $data['registration_number'];
        $user->date_range = $data['date_range'];
        $user->place_issued = $data['place_issued'];
        $user->deputy = $data['deputy'];
        $user->document_number = $data['document_number'];
        $user->address = $data['address'];
        $user->number_share = $data['number_share'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->department_id = $data['department_id'];
        $user->position_id = $data['position_id'];
        $user->is_admin = $data['is_admin'];
        $user->save();
       // $user->update($data);

        foreach ($user->roles as $role) {
            $user->removeRole($role->name);
        }
        foreach ($user->permissions as $permission) {
            $user->revokePermissionTo($permission->name);
        }

        foreach ($data['roles'] as $role) {
            $user->assignRole($role);
        }

        foreach ($data['permissions'] as $permission) {
            $user->givePermissionTo($permission);
        }

        return redirect()->back()->with(['success' => 'Cập nhật user thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with(['success' => 'Xóa user thành công']);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function editNormalUser()
    {
        $user = Auth::user();
        if (!$user) {
            return abort(404);
        }

        return view('admin.pages.user_manage.edit_normal_user', compact('user'));
    }

    public function updateNormalUser(Request $request, $id)
    {
        $request->validate([
            'password' => 'min:4|nullable',
            'email' => 'email:rfc|nullable|max:255|min:4|unique:users,email,' . $id,
        ], [
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',

            'password.min' => 'Password tối thiểu 4 ký tự',
        ]);
        $user = User::where('id',$id)->first();

        if (Auth::user()->id != $id) {
            return abort(404);
        }

        $data = $request->all();
        if ($request->has('password')) {
            if ($request->password == null) {
                $data['password'] = $user->password;
            } else {
                $data['password'] = Hash::make($data['password']);
            }
        }

        // $new_data = [];

        // $new_data['email'] = $data['email'];
        // $new_data['password'] = $data['password'];
        // $new_data['nationality'] =$data['nationality'];
        // $new_data['registration_number'] =$data['registration_number'];
        // $new_data['date_range'] =$data['date_range'];
        // $new_data['place_issued'] =$data['place_issued'];
        // $new_data['deputy'] =$data['deputy'];
        // $new_data['document_number'] =$data['document_number'];
        // $new_data['address'] =$data['address'];
        // // dd($new_data);
        // $user->update($data);
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->nationality = $data['nationality'];
        $user->registration_number = $data['registration_number'];
        $user->date_range = $data['date_range'];
        $user->place_issued = $data['place_issued'];
        $user->deputy = $data['deputy'];
        $user->document_number = $data['document_number'];
        $user->address = $data['address'];
        $user->save();


        return redirect()->back()->with(['success' => 'Cập nhật thông tin thành công']);
    }

    public function importExcel(Request $request)
    {
        // $request->validate([
        //     'customer_list' => 'mimes:xls,xlsx',
        // ], [
        //     'customer_list.mimes' => 'File phải có định dạng xls hoặc xlsx',
        // ]);
        ini_set('max_execution_time', 300); //3 minutes

        Excel::import(new UserImport, 'DS Username.xlsx');

        return redirect()->back()->with(['success' => 'Import dữ liệu thành công']);
    }
}
