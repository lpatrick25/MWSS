<?php

namespace App\Http\Requests\Billing;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'bill_no' => 'required|string|max:255',
            'concessionaire_id' => 'required|exists:concessionaires,id',
            'meter_reading_id' => 'required|exists:meter_readings,id',
            'billing_month' => 'required|string|max:255',
            'payment_deadline' => 'required|date',
            'disconnection_date' => 'required|date|after_or_equal:payment_deadline',
            'amount_due' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Paid,Overdue',
        ];
    }
}
