<?php

namespace App\Http\Requests\Meter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'concessionaire_id' => 'sometimes|required|exists:concessionaires,id',
            'meter_number' => 'sometimes|required|string|unique:meters,meter_number,' . $this->meter->id . '|max:255',
            'installation_date' => 'sometimes|required|date',
            'service_address' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:Active,Inactive',
        ];
    }
}
