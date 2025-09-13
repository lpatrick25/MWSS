<?php

namespace App\Http\Requests\Meter;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'concessionaire_id' => 'required|exists:concessionaires,id',
            'meter_number' => 'required|string|unique:meters,meter_number|max:255',
            'installation_date' => 'required|date',
            'service_address' => 'required|string|max:255',
            'status' => 'nullable|in:Active,Inactive',
        ];
    }
}
