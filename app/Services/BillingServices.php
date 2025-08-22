<?php

namespace App\Services;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Builder;

class BillingServices
{
    public function getAllBillings(array $validated): Builder
    {
        return Billing::query()
            ->with(['concessionaire', 'meterReading'])
            ->when($validated['concessionaire_id'] ?? null, fn ($q) => $q->where('concessionaire_id', $validated['concessionaire_id']))
            ->when($validated['meter_reading_id'] ?? null, fn ($q) => $q->where('meter_reading_id', $validated['meter_reading_id']))
            ->when($validated['status'] ?? null, fn ($q) => $q->where('status', $validated['status']));
    }

    public function create(array $data): Billing
    {
        return Billing::create($data);
    }

    public function update(int $id, array $data): Billing
    {
        $billing = Billing::findOrFail($id);
        $billing->update($data);
        return $billing;
    }
}
