<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiTableSeeder extends Seeder
{
    public function run()
    {
        $divisi = [
            ['nama' => 'SMP'],
            ['nama' => 'SMA'],
        ];

        Divisi::insert($divisi);
    }
}
