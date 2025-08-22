<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'concessionaire_id' => 'required|exists:concessionaires,id',
            'bill_id' => 'required|exists:billings,id',
            'notification_types' => 'required|in:SMS,Email',
            'message' => 'required|string|max:255',
            'status' => 'required|in:Pending,Failed,Sent',
        ];
    }
}
