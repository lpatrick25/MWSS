<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_no',
        'concessionaire_id',
        'meter_reading_id',
        'billing_month',
        'due_date',
        'amount_due',
        'status',
    ];

    protected $casts = [
        'amount_due' => 'decimal:2',
        'status' => 'string',
    ];

    public function concessionaire()
    {
        return $this->belongsTo(Concessionaire::class, 'concessionaire_id');
    }

    public function meterReading()
    {
        return $this->belongsTo(MeterReading::class, 'meter_reading_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bill_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'bill_id');
    }
}
