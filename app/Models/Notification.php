<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'concessionaire_id',
        'bill_id',
        'notification_types',
        'message',
        'status',
    ];

    protected $casts = [
        'notification_types' => 'string',
        'status' => 'string',
    ];

    public function concessionaire()
    {
        return $this->belongsTo(Concessionaire::class, 'concessionaire_id');
    }

    public function bill()
    {
        return $this->belongsTo(Billing::class, 'bill_id');
    }
}
