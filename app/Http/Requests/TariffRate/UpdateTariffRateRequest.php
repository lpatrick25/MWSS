<?php

namespace App\Http\Requests\TariffRate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTariffRateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'effective_date' => 'sometimes|required|date',
            'min_consumption' => 'sometimes|required|integer|min:0',
            'max_consumption' => 'sometimes|required|integer|gt:min_consumption',
            'rate_per_cubic_meter' => 'sometimes|required|numeric|min:0',
        ];
    }
}
