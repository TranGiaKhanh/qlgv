<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|max:30|',
            'confirmPassword'=>'required|same:newPassword'
        ];
    }

    public function messages(){
        return [
            'currentPassword.required' => 'Trường này không được để trống!',
            'currentPassword.min' => 'Trường này có ít nhất 6 ký tự!',
            'newPassword.required' => 'Trường này không được để trống!',
            'newPassword.min' => 'Trường này có ít nhất 6 kí tự!',
            'newPassword.max' => 'Trường này nhiều nhất 30 ký tự!',
            'confirmPassword.required' => 'Trường này không được để trống!',
            'confirmPassword.same' => 'Mật khẩu không khớp nhau!',
        ];

    }
}
