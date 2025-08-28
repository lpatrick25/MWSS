<?php

namespace App\Models;

use App\Support\Traits\HasFullNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFullNameTrait;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'phone_number',
        'email',
        'email_verified_at',
        'password',
        'role',
        'status',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
        'status' => 'string',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function meterReadings()
    {
        return $this->hasMany(MeterReading::class, 'reader_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'collected_by');
    }
}
