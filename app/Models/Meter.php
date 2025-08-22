<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    use HasFactory;

    protected $fillable = [
        'concessionaire_id',
        'meter_number',
        'installation_date',
        'status',
    ];

    protected $casts = [
        'installation_date' => 'date',
        'status' => 'string',
    ];

    public function concessionaire()
    {
        return $this->belongsTo(Concessionaire::class, 'concessionaire_id');
    }

    public function meterReadings()
    {
        return $this->hasMany(MeterReading::class, 'meter_id');
    }
}
