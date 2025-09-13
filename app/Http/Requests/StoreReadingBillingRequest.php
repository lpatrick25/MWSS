<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReadingBillingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'meter_id' => 'required|exists:meters,id',
            'reader_id' => 'nullable|exists:users,id',
            'reading_date' => 'required|date',
            'previous_reading' => 'required|integer|min:0',
            'present_reading' => 'required|integer|min:0|gte:previous_reading',

            'concessionaire_id' => 'required|exists:concessionaires,id',
            'billing_month' => 'required|string|max:255',
            'payment_deadline' => 'required|date',
            'disconnection_date' => 'required|date|after_or_equal:payment_deadline',
            'amount_due' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Paid,Overdue',
        ];
    }
}
