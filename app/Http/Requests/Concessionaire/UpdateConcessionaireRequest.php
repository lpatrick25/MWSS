<?php

namespace App\Http\Requests\Concessionaire;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateConcessionaireRequest extends FormRequest
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
            'address' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:concessionaires,email,' . $this->concessionaire->id . '|max:255',
            'phone_number' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                'regex:/^(09|\+639)\d{9}$/',
                Rule::unique('concessionaires', 'phone_number')->ignore($this->concessionaire->id),
            ],
            'status' => 'sometimes|required|in:Active,Inactive',
        ];
    }
}
