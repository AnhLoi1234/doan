<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Rq_Admin_login extends FormRequest
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
            'username'=>'required|min:8',
            'password'=>'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Tên tài khoản là bắt buộc',
            'username.min'=>'Tối thiểu là 8 ký tự',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min'=>'Mật khẩu tối thiểu 6 ký tự'
        ];
    }
}
