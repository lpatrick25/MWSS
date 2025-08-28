<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'payment_date',
        'amount_paid',
        'amount_change',
        'payment_method',
        'payment_reference',
        'collected_by',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'amount_change' => 'decimal:2',
        'payment_method' => 'string',
    ];

    public function bill()
    {
        return $this->belongsTo(Billing::class, 'bill_id');
    }

    public function collectedBy()
    {
        return $this->belongsTo(User::class, 'collected_by');
    }
}
