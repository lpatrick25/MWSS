<?php

namespace App\Http\Requests\Concessionaire;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConcessionaireRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'account_number' => 'sometimes|required|string|unique:concessionaires,account_number,' . $this->concessionaire->id . '|max:255',
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'extension_name' => 'nullable|string|max:255',
            'service_address' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:concessionaires,email,' . $this->concessionaire->id . '|max:255',
            'phone_number' => 'sometimes|required|string|unique:concessionaires,phone_number,' . $this->concessionaire->id . '|max:255',
            'status' => 'sometimes|required|in:Active,Inactive',
        ];
    }
}
