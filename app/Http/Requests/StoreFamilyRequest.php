<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
