<?php

namespace App\Http\Resources\MeterReading;

use App\Http\Resources\Resource;

class MeterReadingResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'meter_id' => $this->meter_id,
            'reader_id' => $this->reader_id,
            'reading_date' => $this->reading_date,
            'previous_reading' => $this->previous_reading,
            'present_reading' => $this->present_reading,
            'consumption' => $this->consumption,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'meter' => $this->whenLoaded('meter', fn () => [
                'id' => $this->meter->id,
                'meter_number' => $this->meter->meter_number,
                'concessionaire_id' => $this->meter->concessionaire_id,
            ]),
            'reader' => $this->whenLoaded('reader', fn () => [
                'id' => $this->reader->id,
                'first_name' => $this->reader->first_name,
                'last_name' => $this->reader->last_name,
            ]),
        ];
    }
}
