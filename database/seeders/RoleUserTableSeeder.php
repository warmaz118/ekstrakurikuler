<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        // Seed role_user for user_id 1 with role_id 1 to 5
        for ($role_id = 1; $role_id <= 5; $role_id++) {
            DB::table('role_user')->insert([
                'user_id' => 1,
                'role_id' => $role_id,
            ]);
        }
    }
}
