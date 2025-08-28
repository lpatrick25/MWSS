<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'meter_id',
        'reader_id',
        'reading_date',
        'previous_reading',
        'present_reading',
        'consumption',
    ];

    protected $casts = [
        'previous_reading' => 'integer',
        'present_reading' => 'integer',
        'consumption' => 'integer',
    ];

    public function meter()
    {
        return $this->belongsTo(Meter::class, 'meter_id');
    }

    public function reader()
    {
        return $this->belongsTo(User::class, 'reader_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'meter_reading_id');
    }
}
