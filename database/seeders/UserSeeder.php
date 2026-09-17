<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tengeneza/Update Admin User
        User::updateOrCreate(
            ['email' => 'admin@sms.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Tengeneza/Update Manager/Teacher User
        User::updateOrCreate(
            ['email' => 'manager@sms.com'],
            [
                'name' => 'School Manager',
                'password' => Hash::make('password123'),
                'role' => 'teacher', // au 'manager' kulingana na CheckRole yako
            ]
        );

        // 3. Tengeneza/Update Student User
        User::updateOrCreate(
            ['email' => 'student@sms.com'],
            [
                'name' => 'Test Student',
                'password' => Hash::make('password123'),
                'role' => 'student',
            ]
        );
    }
}