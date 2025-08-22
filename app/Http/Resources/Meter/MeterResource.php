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
            'installation_date' => $this->installation_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'concessionaire' => $this->whenLoaded('concessionaire', fn () => [
                'id' => $this->concessionaire->id,
                'account_number' => $this->concessionaire->account_number,
                'first_name' => $this->concessionaire->first_name,
                'last_name' => $this->concessionaire->last_name,
            ]),
        ];
    }
}
