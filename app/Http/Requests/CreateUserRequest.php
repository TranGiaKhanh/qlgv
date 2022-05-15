<?php

namespace App\Http\Requests;

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
            'name' => 'required|min:3|max:30',
            'email' => 'required|unique:users,email|email|max:255',
            'phone' => 'nullable|numeric|digits:10',
            'password' => 'required|max:255',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'address' => 'nullable|max:255',
            'role_id' => [
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        return $fail('Yêu cầu chọn !');
                    }
                }
            ],
            // 'department_id' => [
            //     function ($attribute, $value, $fail) {
            //         if ($value == 0) {
            //             return $fail('Yêu cầu chọn !');
            //         }
            //     }
            // ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này không thể để trống ! ',
            'name.min' => 'Trường này không được viết ít hơn  3 kí tự !',
            'name.max' => 'Trường này không được viết nhiều hơn 30 kí tự !',
            'email.required' => 'Trường này không thể để trống ! ',
            'email.max' => 'Trường này không được viết nhiều hơn 255 kí tự !',
            'email.email' => 'Email không hợp lệ !',
            'email.unique' => 'Email đã tồn tại !',
            'phone.numeric' => 'Trường này chỉ được là số !',
            'phone.digits' => 'Trường này có độ dài là 10 chữ số !',
            'password.required' => 'Trường này không thể để trống ! ',
            'password.max' => 'Trường này không được viết nhiều hơn 255 kí tự !',
            'address.required' => 'Trường này không thể để trống ! ',
            'address.max' => 'Trường này không được viết nhiều hơn 255 kí tự !',
            'birthday.required' => 'Trường này không thể để trống !',
            'birthday.date_format' => 'Trường này phải đúng với định dạng Y-m-d !',
            'birthday.before' => 'Trường này không được lớn hơn ngày hiện tại ! ',
        ];
    }
}
