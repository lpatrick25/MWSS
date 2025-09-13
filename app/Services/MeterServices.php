<?php

namespace App\Services;

use App\Models\Meter;
use Illuminate\Database\Eloquent\Builder;

class MeterServices
{
    public function getAllMeters(array $validated): Builder
    {
        return Meter::query()
            ->with('concessionaire')
            ->when($validated['concessionaire_id'] ?? null, fn ($q) => $q->where('concessionaire_id', $validated['concessionaire_id']))
            ->when($validated['status'] ?? null, fn ($q) => $q->where('status', $validated['status']));
    }

    public function create(array $data): Meter
    {
        return Meter::create($data);
    }

    public function update(int $id, array $data): Meter
    {
        $meter = Meter::findOrFail($id);
        $meter->update($data);
        return $meter;
    }

    public function changeStatus(int $id): Meter
    {
        $meter = Meter::findOrFail($id);
        if ($meter->status === 'Inactive') {
            $meter->update(['status' => 'Active']);
            return $meter;
        }
        $meter->update(['status' => 'Inactive']);
        return $meter;
    }
}
