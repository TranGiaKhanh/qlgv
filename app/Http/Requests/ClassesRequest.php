<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassesRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'manager' => 'max:255'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Không được để trống tên',
            'name.min' => 'Tên không được ít hơn 3 kí tự',
            'name.max' => 'Tên quá dài',
            'manager.max' => 'Mô tả không dài quá 255 kí tự'
        ];
    }
}
