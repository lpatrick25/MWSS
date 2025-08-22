<?php

namespace App\Http\Resources\Billing;

use App\Http\Resources\Resource;

class BillingResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'bill_no' => $this->bill_no,
            'concessionaire_id' => $this->concessionaire_id,
            'meter_reading_id' => $this->meter_reading_id,
            'billing_month' => $this->billing_month,
            'due_date' => $this->due_date,
            'amount_due' => $this->amount_due,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'concessionaire' => $this->whenLoaded('concessionaire', fn () => [
                'id' => $this->concessionaire->id,
                'account_number' => $this->concessionaire->account_number,
                'first_name' => $this->concessionaire->first_name,
                'last_name' => $this->concessionaire->last_name,
            ]),
            'meter_reading' => $this->whenLoaded('meterReading', fn () => [
                'id' => $this->meterReading->id,
                'meter_id' => $this->meterReading->meter_id,
                'previous_reading' => $this->meterReading->previous_reading,
                'present_reading' => $this->meterReading->present_reading,
                'consumption' => $this->meterReading->consumption,
            ]),
        ];
    }
}
