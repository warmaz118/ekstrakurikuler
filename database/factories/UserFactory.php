<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Divisi;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'isactive' => $this->faker->boolean,  // Random isactive value
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Assign divisi_id (1 or 2) in user_divisi
            $divisi = Divisi::inRandomOrder()->first();
            $user->divisi()->attach([$divisi->id]);

            // Assign role_id berdasarkan divisi_id
            if ($divisi->id == 1) {
                // Jika divisi_id 1, maka role_id dapat 2 atau 4
                $roleId = Role::whereIn('id', [2, 4])->inRandomOrder()->first()->id;
            } else {
                // Jika divisi_id 2, maka role_id dapat 3 atau 5
                $roleId = Role::whereIn('id', [3, 5])->inRandomOrder()->first()->id;
            }

            $user->roles()->attach([$roleId]);
        });
    }
}
