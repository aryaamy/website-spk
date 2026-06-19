<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Prodi',
            'email' => 'admin@kampus.ac.id',
            'password' => Hash::make('password123'), // Ini password lu nanti
        ]);
    }
}