<?php

namespace App\Http\Requests\Admin\UserManage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPosition extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_update' => 'required|max:255',
            'department_id' => 'required|numeric',
            'level_update' => 'numeric',
            'user_position_id' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên chức vụ không được để trống',
            'name.max' => 'Tên chức vụ tối đa 255 ký tự',

            'department_id.required' => 'ID phòng ban không được để trống',
            'department_id.numeric' => 'ID phòng ban phải là kiểu số',

            'level_update.numeric' => 'Level phải là kiểu số',

            'user_position_id.required' => 'ID chức vụ không được để trống',

        ];
    }
}