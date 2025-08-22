<?php

namespace App\Http\Requests\Concessionaire;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcessionaireRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'account_number' => 'required|string|unique:concessionaires,account_number|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'extension_name' => 'nullable|string|max:255',
            'service_address' => 'required|string|max:255',
            'email' => 'required|string|email|unique:concessionaires,email|max:255',
            'phone_number' => 'required|string|unique:concessionaires,phone_number|max:255',
            'status' => 'nullable|in:Active,Inactive',
        ];
    }
}
