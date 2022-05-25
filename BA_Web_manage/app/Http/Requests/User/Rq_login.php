<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Rq_login extends FormRequest
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
            'email' =>'required|email',
            'password' =>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email là bắt buộc',
            'email.email'=>'Địa chỉ maill không hợp lệ',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min'=>'Mật khẩu tối thiểu 6 ký tự',
        ];
    }
}
