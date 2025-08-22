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
        'rate_per_cubic_meter',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'min_consumption' => 'integer',
        'max_consumption' => 'integer',
        'rate_per_cubic_meter' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('effective_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>', now());
            });
    }

    public function scopeForConsumption($query, $consumption)
    {
        return $query->where('min_consumption', '<=', $consumption)
            ->where('max_consumption', '>=', $consumption);
    }
}
