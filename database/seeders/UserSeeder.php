<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'John Doe',
            'email' => 'jDoe@clsu2.edu.ph',
        ]);

        $contractor = User::create([
            'name' => 'Lorem Ipsum',
            'email' => 'lIpsum@clsu2.edu.ph',
        ]);

        $subAdmin = User::create([
            'name' => 'Vincent Joshua Xander',
            'email' => 'vjxander@clsu2.edu.ph',
        ]);

    }
}
