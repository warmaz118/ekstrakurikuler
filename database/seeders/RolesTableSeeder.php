<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Super Admin', 'description' => 'Administrator with full access'],
            ['name' => 'Admin SMP', 'description' => 'Administrator for SMP'],
            ['name' => 'Admin SMA', 'description' => 'Administrator for SMA'],
            ['name' => 'Pembimbing SMP', 'description' => 'SMP guide'],
            ['name' => 'Pembimbing SMA', 'description' => 'SMA guide'],
            ['name' => 'Siswa SMP', 'description' => 'SMP student'],
            ['name' => 'Siswa SMA', 'description' => 'SMA student'],
        ];

        Role::insert($roles);
    }
}
