<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'concessionaire_id' => 'sometimes|required|exists:concessionaires,id',
            'bill_id' => 'sometimes|required|exists:billings,id',
            'notification_types' => 'sometimes|required|in:SMS,Email',
            'message' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:Pending,Failed,Sent',
        ];
    }
}
