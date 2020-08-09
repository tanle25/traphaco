<?php

namespace App\Http\Requests\Admin\UserManage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $old_user = $this->old_user;
        return [
            'fullname' => 'required|max:255',
            'password' => 'min:6|nullable',
            'username' => 'required|max:255|min:4|unique:users,username,' . $old_user,
            'email' => 'email:rfc|nullable|max:255|min:4|unique:users,email,' . $old_user,
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
            'fullname.required' => 'Họ tên không được để trống',
            'fullname.max:255' => 'Họ tên tối đa 255 ký tự',

            'username.required' => 'Username không được để trống',
            'username.max:255' => 'Username tối đa 255 ký tự',
            'username.unique' => 'Username đã tồn tại',

            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',

            'password.min' => 'Password tối thiểu 6 ký tự',
        ];
    }
}