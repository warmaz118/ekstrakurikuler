<?php

namespace Database\Factories;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        // Buat user baru
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'isactive' => $this->faker->boolean,  // Random isactive value
        ]);

        // Ambil divisi secara acak
        $divisi = Divisi::inRandomOrder()->first();

        // Tentukan kelas berdasarkan divisi_id
        if ($divisi->id == 1) {
            $kelas = $this->faker->numberBetween(7, 9); // Kelas 7, 8, atau 9 untuk divisi_id 1
        } else {
            $kelas = $this->faker->numberBetween(10, 12); // Kelas 10, 11, atau 12 untuk divisi_id 2
        }

        return [
            'user_id' => $user->id,  // Menggunakan user yang baru dibuat
            'nis' => $this->faker->unique()->numerify('#####'), // Format NIS
            'kelas' => $kelas, // Menghasilkan kelas berdasarkan divisi
            'alamat' => $this->faker->address, // Menghasilkan alamat acak
            'divisi_id' => $divisi->id, // Mengambil divisi
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Siswa $siswa) {
            // Assign role_id berdasarkan divisi_id
            $roleId = $siswa->divisi_id === 1 ? 6 : 7; // Jika divisi_id 1, maka role_id 6, jika tidak, maka 7
            $siswa->user->roles()->attach($roleId);
        });
    }
}
