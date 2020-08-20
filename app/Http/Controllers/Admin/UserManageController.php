<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserManage\CreateUserRequest;
use App\Http\Requests\Admin\UserManage\UpdateUserRequest;
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
                return '<a href="' . route('admin.usermanage.edit', $user->id) . '"class="btn text-success"><i class="fas fa-user-edit"></i></a>
                        <a href="' . route('admin.usermanage.destroy', $user->id) . '" class="btn text-danger"><i class="far fa-trash-alt"></i></a>';
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
        $newUser = User::create($data);

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

        $user->update($data);

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

    public function updateNormalUser(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

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

        $new_data = [];

        $new_data['username'] = $data['username'];
        $new_data['fullname'] = $data['fullname'];
        $new_data['email'] = $data['email'];
        $new_data['password'] = $data['password'];

        $user->update($data);
        return redirect()->back()->with(['success' => 'Cập nhật thông tin thành công']);
    }
}