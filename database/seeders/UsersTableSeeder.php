<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Admin SMP',
                'email' => 'admin_smp@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Admin SMA',
                'email' => 'admin_sma@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pembimbing SMP',
                'email' => 'pembimbing_smp@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pembimbing SMA',
                'email' => 'pembimbing_sma@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
