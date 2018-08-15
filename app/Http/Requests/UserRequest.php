<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'phone' => 'required|numeric',
            'email' => 'required|string|max:30|email',
            'password' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'email.max' => 'ку-ку 30 символов максимум'
        ];
    }
}
