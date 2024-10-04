<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'password' => 'required|min:8|string',
            'family.*.name' => 'nullable|required_with:family.*.relationship|string|max:255',
            'family.*.relationship' => 'nullable|required_with:family.*.name|string|max:255',
            'family.*.date_of_birth' => 'nullable|date',
        ];
    }
}
