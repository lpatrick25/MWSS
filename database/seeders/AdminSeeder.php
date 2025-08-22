<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'System',
                'middle_name' => null,
                'last_name' => 'Admin',
                'extension_name' => null,
                'phone_number' => '1234567890',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin12345'),
                'role' => 'Admin',
                'status' => 'Active',
            ]
        );
    }
}
