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
            'payment_deadline' => $this->payment_deadline,
            'disconnection_date' => $this->disconnection_date,
            'amount_due' => $this->amount_due,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'concessionaire' => $this->whenLoaded('concessionaire', fn () => [
                'id' => $this->concessionaire->id,
                'account_number' => $this->concessionaire->account_number,
                'full_name' => $this->concessionaire->full_name,
            ]),
            'meter_reading' => $this->whenLoaded('meterReading', fn () => [
                'id' => $this->meterReading->id,
                'meter_id' => $this->meterReading->meter_id,
                'meter_number' => $this->meterReading->meter->meter_number,
                'previous_reading' => $this->meterReading->previous_reading,
                'present_reading' => $this->meterReading->present_reading,
                'consumption' => $this->meterReading->consumption,
            ]),
        ];
    }
}
