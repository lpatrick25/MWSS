<?php

namespace App\Http\Resources\Notification;

use App\Http\Resources\Resource;

class NotificationResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'concessionaire_id' => $this->concessionaire_id,
            'bill_id' => $this->bill_id,
            'notification_types' => $this->notification_types,
            'message' => $this->message,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'concessionaire' => $this->whenLoaded('concessionaire', fn () => [
                'id' => $this->concessionaire->id,
                'account_number' => $this->concessionaire->account_number,
                'first_name' => $this->concessionaire->first_name,
                'last_name' => $this->concessionaire->last_name,
            ]),
            'bill' => $this->whenLoaded('bill', fn () => [
                'id' => $this->bill->id,
                'bill_no' => $this->bill->bill_no,
                'amount_due' => $this->bill->amount_due,
            ]),
        ];
    }
}
