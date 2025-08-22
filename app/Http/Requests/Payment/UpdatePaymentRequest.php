<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'bill_id' => 'sometimes|required|exists:billings,id',
            'payment_date' => 'sometimes|required|date',
            'amount_paid' => 'sometimes|required|numeric|min:0',
            'payment_method' => 'sometimes|required|in:Cash,Online',
            'payment_reference' => 'nullable|string|max:255',
            'collected_by' => 'sometimes|nullable|exists:users,id',
        ];
    }
}
