<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'extension_name' => 'nullable|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'unique:concessionaires,phone_number',
                'regex:/^(09|\+639)\d{9}$/',
            ],
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Admin,Meter Reader,Cashier,Head',
            'status' => 'nullable|in:Active,Inactive',
        ];
    }
}
