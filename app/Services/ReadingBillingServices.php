<?php

namespace App\Services;

use App\Models\MeterReading;
use Illuminate\Database\Eloquent\Builder;

class ReadingBillingServices
{
    public function getAllMeterReadings(array $validated): Builder
    {
        return MeterReading::with('billing')
            ->with(['meter', 'reader'])
            ->when($validated['meter_id'] ?? null, fn($q) => $q->where('meter_id', $validated['meter_id']))
            ->when($validated['reader_id'] ?? null, fn($q) => $q->where('reader_id', $validated['reader_id']));
    }
}
