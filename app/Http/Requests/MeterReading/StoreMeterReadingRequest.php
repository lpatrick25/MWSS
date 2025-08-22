<?php

namespace App\Http\Requests\MeterReading;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeterReadingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'meter_id' => 'required|exists:meters,id',
            'reader_id' => 'required|exists:users,id',
            'reading_date' => 'required|date',
            'previous_reading' => 'required|integer|min:0',
            'present_reading' => 'required|integer|min:0|gte:previous_reading',
        ];
    }
}
