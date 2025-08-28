<?php

namespace App\Http\Resources\TariffRate;

use App\Http\Resources\Resource;

class TariffRateResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'effective_date' => $this->effective_date,
            'min_consumption' => $this->min_consumption,
            'max_consumption' => $this->max_consumption,
            'flat_amount' => $this->flat_amount,
            'rate_per_cubic_meter' => $this->rate_per_cubic_meter,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
