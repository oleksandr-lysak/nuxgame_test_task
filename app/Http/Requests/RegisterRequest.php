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
            'username' => 'required|unique:users,username|string|max:255',
            'phonenumber' => 'required|unique:users,phonenumber|string|max:32',
        ];
    }
} 