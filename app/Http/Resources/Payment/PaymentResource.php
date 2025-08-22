<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\Resource;

class PaymentResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'bill_id' => $this->bill_id,
            'payment_date' => $this->payment_date,
            'amount_paid' => $this->amount_paid,
            'payment_method' => $this->payment_method,
            'payment_reference' => $this->payment_reference,
            'collected_by' => $this->collected_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'bill' => $this->whenLoaded('bill', fn () => [
                'id' => $this->bill->id,
                'bill_no' => $this->bill->bill_no,
                'concessionaire_id' => $this->bill->concessionaire_id,
                'amount_due' => $this->bill->amount_due,
            ]),
            'collected_by_user' => $this->whenLoaded('collectedBy', fn () => [
                'id' => $this->collectedBy->id,
                'first_name' => $this->collectedBy->first_name,
                'last_name' => $this->collectedBy->last_name,
            ]),
        ];
    }
}
