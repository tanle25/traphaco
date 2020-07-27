<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserManage\CreateUserRequest;
use App\Http\Requests\Admin\UserManage\UpdateUserRequest;
use App\Models\Department;
use App\Models\UserPosition;
use App\User;
use DataTables;
use DB;
use Hash;
use Illuminate\Http\Request;

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
        $departments = Department::all()->sortBy('id');
        $user_positions = UserPosition::all()->sortBy('level');

        return view('admin.pages.user_manage.create', compact('departments', 'user_positions'));
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
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->back()->with(['success' => 'Tạo user mới thành công']);
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
        $user = User::findOrFail($id);
        $departments = Department::all()->sortBy('id');
        $user_positions = UserPosition::all()->sortBy('level');

        return view('admin.pages.user_manage.edit', compact('departments', 'user_positions', 'user'));
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

        if ($request->has('is_admin') && $data['is_admin'] == 'on') {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }

        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
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
}