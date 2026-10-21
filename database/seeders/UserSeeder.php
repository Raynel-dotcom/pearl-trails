<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@exploreuganda.test'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Vendor
        User::updateOrCreate(
            ['email' => 'vendor@exploreuganda.test'],
            [
                'name' => 'Safari Vendor',
                'password' => Hash::make('password'),
                'role' => 'vendor',
                'email_verified_at' => now(),
            ]
        );

        // Visitor
        User::updateOrCreate(
            ['email' => 'visitor@exploreuganda.test'],
            [
                'name' => 'Happy Traveler',
                'password' => Hash::make('password'),
                'role' => 'visitor',
                'email_verified_at' => now(),
            ]
        );
    }
}
