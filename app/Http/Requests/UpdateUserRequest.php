<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow everyone to make this request
    }

    public function rules()
    {
        $userId = $this->route('user')->id; // Get the current user ID for unique email check

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'family.*.name' => 'nullable|required_with:family.*.relationship|string|max:255',
            'family.*.relationship' => 'nullable|required_with:family.*.name|string|max:255',
            'family.*.date_of_birth' => 'nullable|date',
        ];
    }
}

