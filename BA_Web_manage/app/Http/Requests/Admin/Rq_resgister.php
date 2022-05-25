<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Rq_resgister extends FormRequest
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
            'name'=>'required|max:255',
            'username'=>'required|min:8|unique:m__admins',
            'password'=>'required|min:6',
            'role'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc',
            'name.max'=>'Tối thiểu 255 ký tự',
            'username.required' => 'Tên tài khoản là bắt buộc',
            'username.min'=>'Tối thiểu là 8 ký tự',
            'username.unique'=>'Tên tài khoản đã tồn tại',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min'=>'Mật khẩu tối thiểu 6 ký tự'
        ];
    }
}
