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
            'max_consumption' => 'sometimes|nullable|integer|min:0|gte:min_consumption',
            'flat_amount' => 'sometimes|required|numeric|min:0',
            'rate_per_cubic_meter' => 'sometimes|required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'max_consumption.gte' => 'The max consumption must be greater than or equal to the min consumption.',
            'flat_amount.required' => 'The flat amount is required.',
            'rate_per_cubic_meter.required' => 'The rate per cubic meter is required.',
        ];
    }
}
