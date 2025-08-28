<?php

namespace App\Services;

use App\Models\Concessionaire;
use Illuminate\Database\Eloquent\Builder;

class ConcessionaireServices
{
    public function getAllConcessionaires(array $validated): Builder
    {
        return Concessionaire::query()
            ->when($validated['status'] ?? null, fn ($q) => $q->where('status', $validated['status']));
    }

    public function create(array $data): Concessionaire
    {
        $accountNumber = date('d-m') . '-' . str_pad((int) date('d-m') + 1, 5, '0', STR_PAD_LEFT);
        $data['account_number'] = $accountNumber;
        return Concessionaire::create($data);
    }

    public function update(int $id, array $data): Concessionaire
    {
        $concessionaire = Concessionaire::findOrFail($id);
        $concessionaire->update($data);
        return $concessionaire;
    }
}
