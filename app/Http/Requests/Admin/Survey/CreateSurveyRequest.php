<?php

namespace App\Http\Requests\Admin\Survey;

use Illuminate\Foundation\Http\FormRequest;

class CreateSurveyRequest extends FormRequest
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
            'name' => 'required|max:255',
            'title' => 'max:255',
            'create_by' => 'numeric',
            'content' => 'max:1024',
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
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên tối đa 255 ký tự',

            'title.max' => 'Title tối đa 255 ký tự',

            'create_by.numeric' => 'create_by phải là kiểu số',

            'content.max' => 'Content tối đa 1024 ký tự',
        ];
    }

}