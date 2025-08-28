<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'effective_date',
        'min_consumption',
        'max_consumption',
        'flat_amount',
        'rate_per_cubic_meter',
    ];

    protected $casts = [
        'min_consumption' => 'integer',
        'max_consumption' => 'integer',
        'flat_amount' => 'decimal:2',
        'rate_per_cubic_meter' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('effective_date', '<=', now());
    }

    public function scopeForConsumption($query, $consumption)
    {
        return $query->where('min_consumption', '<=', $consumption)
            ->where(function ($q) use ($consumption) {
                $q->whereNull('max_consumption')
                    ->orWhere('max_consumption', '>=', $consumption);
            });
    }
}
