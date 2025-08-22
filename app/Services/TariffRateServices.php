<?php

namespace App\Services;

use App\Models\TariffRate;
use Illuminate\Database\Eloquent\Builder;

class TariffRateServices
{
    public function getAllTariffRates(array $validated): Builder
    {
        return TariffRate::query()
            ->when($validated['effective_date'] ?? null, fn ($q) => $q->where('effective_date', $validated['effective_date']));
    }

    public function create(array $data): TariffRate
    {
        return TariffRate::create($data);
    }

    public function update(int $id, array $data): TariffRate
    {
        $tariffRate = TariffRate::findOrFail($id);
        $tariffRate->update($data);
        return $tariffRate;
    }
}
