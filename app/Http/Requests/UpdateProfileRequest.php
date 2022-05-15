<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'phone' => 'nullable|numeric|digits:10',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'phone.numeric' => 'Trường này chỉ được là số !',
            'phone.digits' => 'Trường này có độ dài là 10 chữ số !',
            'birthday.required' => 'Trường này không thể để trống !',
            'birthday.date_format' => 'Trường này phải đúng với định dạng Y-m-d !',
            'birthday.before' => 'Trường này không được lớn hơn ngày hiện tại ! ',
            'image.mimes' => 'Chỉ nhận được các định dạng: jpg, jpeg, png !',
            'image.max' => 'Kích thước tối đa là của ảnh 5M !'
        ];
    }
}
