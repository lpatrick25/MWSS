<?php

namespace App\Http\Requests\MeterReading;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeterReadingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'meter_id' => 'sometimes|required|exists:meters,id',
            'reader_id' => 'sometimes|required|exists:users,id',
            'reading_date' => 'sometimes|required|date',
            'previous_reading' => 'sometimes|required|integer|min:0',
            'present_reading' => 'sometimes|required|integer|min:0|gte:previous_reading',
        ];
    }
}
