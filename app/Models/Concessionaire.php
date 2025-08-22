<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concessionaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'service_address',
        'email',
        'phone_number',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function meters()
    {
        return $this->hasMany(Meter::class, 'concessionaire_id');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'concessionaire_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'concessionaire_id');
    }
}
