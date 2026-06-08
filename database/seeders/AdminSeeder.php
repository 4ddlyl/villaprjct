<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@villabooking.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}