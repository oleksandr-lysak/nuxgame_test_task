<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_name' => 'required|unique:users,user_name|string|max:255',
            'phone_number' => 'required|unique:users,phone_number|string|max:32',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'User name is required',
            'user_name.unique' => 'User name already exists',
            'user_name.string' => 'User name must be a string',
            'user_name.max' => 'User name must be less than 255 characters',
            'phone_number.required' => 'Phone number is required',
            'phone_number.unique' => 'Phone number already exists',
            'phone_number.string' => 'Phone number must be a string',
            'phone_number.max' => 'Phone number must be less than 32 characters',
        ];
    }
} 