<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'role' => 'mentee',
            'is_verified' => true,
        ];
    }

    public function admin()
    {
        return $this->state([
            'role' => 'admin',
            'is_verified' => true,
        ]);
    }

    public function mentor()
    {
        return $this->state([
            'role' => 'mentor',
            'is_verified' => false, // butuh approval
        ]);
    }

    public function mentee()
    {
        return $this->state([
            'role' => 'mentee',
        ]);
    }
}
