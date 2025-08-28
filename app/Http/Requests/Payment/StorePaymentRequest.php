<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'bill_id' => 'required|exists:billings,id',
            'payment_date' => 'required|date',
            'amount_paid' => 'required|numeric|min:0',
            'amount_change' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Cash,Online',
            'payment_reference' => 'nullable|string|max:255',
            'collected_by' => 'nullable|exists:users,id',
        ];
    }
}
