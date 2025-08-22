<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'extension_name' => 'nullable|string|max:255',
            'phone_number' => 'sometimes|required|string|unique:users,phone_number,' . $this->user->id . '|max:255',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $this->user->id . '|max:255',
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|in:Admin,Meter Reader,Cashier,Head',
            'status' => 'sometimes|required|in:Active,Inactive',
        ];
    }
}
