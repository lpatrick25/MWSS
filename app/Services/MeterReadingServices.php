<?php

namespace App\Services;

use App\Models\MeterReading;
use Illuminate\Database\Eloquent\Builder;

class MeterReadingServices
{
    public function getAllMeterReadings(array $validated): Builder
    {
        return MeterReading::query()
            ->with(['meter', 'reader'])
            ->when($validated['meter_id'] ?? null, fn ($q) => $q->where('meter_id', $validated['meter_id']))
            ->when($validated['reader_id'] ?? null, fn ($q) => $q->where('reader_id', $validated['reader_id']));
    }

    public function create(array $data): MeterReading
    {
        // Calculate consumption
        $data['consumption'] = $data['present_reading'] - $data['previous_reading'];
        return MeterReading::create($data);
    }

    public function update(int $id, array $data): MeterReading
    {
        $meterReading = MeterReading::findOrFail($id);
        // Recalculate consumption if readings are updated
        if (isset($data['present_reading']) && isset($data['previous_reading'])) {
            $data['consumption'] = $data['present_reading'] - $data['previous_reading'];
        }
        $meterReading->update($data);
        return $meterReading;
    }
}
