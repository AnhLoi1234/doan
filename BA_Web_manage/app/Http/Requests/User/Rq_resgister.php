<?php

namespace App\Http\Requests\User;

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
            'fullname'=>'required|max:255',
            'gender'=>'required',
            'password'=>'required|min:6',
            'phone'=>'required|numeric',
            'email'=>'required|email|unique:m_users',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Tên người dùng là bắt buộc',
            'fullname.max'=>'Tối thiểu 255 ký tự',
            'gender.required' => 'Vui lòng chọn giới tính',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'phone.numeric'=>'Số điện thoại không hợp lệ',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Địa chỉ email không hợp lệ',
            'email.unique'=>'Địa chỉ email đã tồn tại',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min'=>'Mật khẩu tối thiểu 6 ký tự'
        ];
    }
}
