<?php

namespace App\Http\Resources\Meter;

use App\Http\Resources\Resource;

class MeterResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'concessionaire_id' => $this->concessionaire_id,
            'meter_number' => $this->meter_number,
            'installation_date' => date('F j, Y', strtotime($this->installation_date)),
            'service_address' => $this->service_address,
            'initial_reading' => $this->initial_reading,
            'status' => $this->status,
            'concessionaire' => $this->whenLoaded('concessionaire', fn () => [
                'id' => $this->concessionaire->id,
                'account_number' => $this->concessionaire->account_number,
                'full_name' => $this->concessionaire->full_name,
            ]),
        ];
    }
}
