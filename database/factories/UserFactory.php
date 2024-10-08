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
            $divisiId = Divisi::inRandomOrder()->first()->id;
            $user->divisi()->attach([$divisiId]);

            // Assign role_id (between 2 and 5) in role_user
            $roleId = Role::whereBetween('id', [2, 5])->inRandomOrder()->first()->id;
            $user->roles()->attach([$roleId]);
        });
    }
}
