<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserManage\CreateUserPosition;
use App\Http\Requests\Admin\UserManage\UpdateUserPosition;
use App\Models\UserPosition;
use Illuminate\Http\Request;

class UserPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CreateUserPosition $request)
    {
        UserPosition::create($request->all());

        return redirect()->back()->with(['success' => 'Thêm vị trí mới thành công']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPosition $request)
    {
        $data = [
            'name' => $request->name_update,
            'level' => $request->level_update,
        ];
        $userPosition = UserPosition::find($request->user_position_id);
        $userPosition->update($data);

        return redirect()->back()->with(['success' => 'Cập nhật vị trí mới thành công']);
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
            UserPosition::findOrFail($request->id)->delete();
            return ['message' => 'Xóa thành công chức vụ'];
        }
        return ['error' => 'Không tìm thấy dữ liệu'];
    }
}