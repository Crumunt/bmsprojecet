<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Login;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::find(1);
        $admin->login()->create([
            'password' => Hash::make('password123'),
            'user_type' => 'admin',
            'last_login_attempt' => now(),
        ]);

        $contractor = User::find(2);
        $contractor->login()->create([
            'password' => Hash::make('password123'),
            'user_type' => 'sub-admin',
            'last_login_attempt' => now(),
        ]);

        $subAdmin = User::find(3);
        $subAdmin->login()->create([
            'password' => Hash::make('password123'),
            'user_type' => 'sub-admin',
            'last_login_attempt' => now(),
        ]);
    }
}
