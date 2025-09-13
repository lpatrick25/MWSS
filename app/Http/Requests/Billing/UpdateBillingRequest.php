<?php

namespace App\Http\Requests\Billing;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'bill_no' => 'sometimes|required|string|max:255',
            'concessionaire_id' => 'sometimes|required|exists:concessionaires,id',
            'meter_reading_id' => 'sometimes|required|exists:meter_readings,id',
            'billing_month' => 'sometimes|required|string|max:255',
            'payment_deadline' => 'sometimes|required|date',
            'disconnection_date' => 'sometimes|required|date|after_or_equal:payment_deadline',
            'amount_due' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|in:Pending,Paid,Overdue',
        ];
    }
}
