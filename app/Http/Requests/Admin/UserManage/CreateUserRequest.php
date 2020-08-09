<?php

namespace App\Http\Requests\Admin\UserManage;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'fullname' => 'required|max:255',
            'password' => 'required|min:6',
            'username' => 'required|max:255|min:4|unique:users,username',
            'email' => 'email:rfc|nullable|max:255|min:4|unique:users,username',
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

            'password.required' => 'Password không được để trống',
            'password.min' => 'Password tối thiểu 6 ký tự',
        ];
    }
}