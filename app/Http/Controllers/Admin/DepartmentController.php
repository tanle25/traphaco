<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortByDesc('name');
        $departments = Department::all()->sortByDesc('name');
        return view('admin.pages.departments.list', compact('users', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|max:256',
            'manage_id' => 'numeric|nullable',
            'parent_id' => 'numeric|nullable',
        ], [
            'department_name.required' => 'Tên không được để trống',
            'department_name.max' => 'Tên tối đa 256 ký tự',

            'manage_id.numeric' => 'Manage_id sai định dạng',
            'parent_id.numeric' => 'Phòng ban trực thuộc sai định dạng',
        ]);
        Department::create($request->all());
        return redirect()->back()->with('success', 'Thêm mới thành công');

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
        $users = User::all()->sortByDesc('name');
        $departments = Department::all()->sortByDesc('id');
        $current_department = Department::findOrFail($id);
        $user_positions = $current_department->user_positions;
        return view('admin.pages.departments.edit', ['user_positions' => $user_positions, 'users' => $users, 'departments' => $departments, 'current_department' => $current_department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'department_name' => 'required|max:256',
            'manage_id' => 'numeric|nullable',
            'parent_id' => 'numeric|nullable',
        ], [
            'department_name.required' => 'Tên không được để trống',
            'department_name.max' => 'Tên tối đa 256 ký tự',

            'manage_id.numeric' => 'Manage_id sai định dạng',
            'parent_id.numeric' => 'Phòng ban trực thuộc sai định dạng',
        ]);
        $department = Department::findOrFail($id);
        $data = $request->all();
        $department->update($data);
        return redirect()->back()->with('success', 'Cập nhật phòng ban thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->id) {
            Department::findOrFail($request->id)->delete();
            return ['message' => 'Xóa thành công'];
        }
        return ['error' => 'Không tìm thấy dữ liệu'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveTree(Request $request)
    {
        $data = $request->jsonData;
        $result = [];
        function getDepartmentAndParent($result, $array, $parent_id)
        {
            foreach ($array as $key => $item) {
                //return $item['id'];
                array_push($result, ['id' => $item['id'], 'parent_id' => $parent_id, 'sort' => $key + 1]);
                if (array_key_exists('children', $item)) {
                    array_push($result, ...getDepartmentAndParent([], $item['children'], $item['id']));
                }
            }
            return $result;
        }

        $result = getDepartmentAndParent([], $data, null);
        foreach ($result as $item) {
            $department = Department::find($item['id']);
            $department->parent_id = $item['parent_id'];
            $department->sort = $item['sort'];
            $department->save();
        }
        return $result;
    }
}
