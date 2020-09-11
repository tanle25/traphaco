<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.pages.permission.index', ['roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'role_name' => 'required|unique:roles,name|max:255',
        ], [
            'role_name.unique' => 'Tên vai trò đã tồn tại',
            'role_name.required' => 'Tên vai trò không được để trống',
        ]);

        if (!$request->has('permissions')) {
            $permissions = [];
        } else {
            $permissions = $request->permissions;
        }

        DB::beginTransaction();
        try {
            $new_role = Role::create([
                'name' => $request->role_name,
            ]);

            foreach ($permissions as $permission) {
                $new_role->givePermissionTo($permission);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->back()->with(['success' => 'Tạo mới vai trò thành công']);

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
        $roles = Role::all();
        $permissions = Permission::all();
        $current_role = Role::findOrFail($id);
        return view('admin.pages.permission.edit_role', compact('roles', 'permissions', 'current_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'role_name' => 'max:255|required|unique:roles,name,' . $id,
        ], [
            'role_name.unique' => 'Tên vai trò đã tồn tại',
            'role_name.required' => 'Tên vai trò không được để trống',
        ]);

        if (!$request->has('permissions')) {
            $permissions = [];
        } else {
            $permissions = $request->permissions;
        }

        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->role_name,
        ]);

        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        return redirect()->route('admin.permission.index')->with(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return ['success' => 'Xóa thành công'];
    }
}