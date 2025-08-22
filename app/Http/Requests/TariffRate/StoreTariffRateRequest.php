<?php

namespace App\Http\Requests\TariffRate;

use Illuminate\Foundation\Http\FormRequest;

class StoreTariffRateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'effective_date' => 'required|date',
            'min_consumption' => 'required|integer|min:0',
            'max_consumption' => 'required|integer|gt:min_consumption',
            'rate_per_cubic_meter' => 'required|numeric|min:0',
        ];
    }
}
