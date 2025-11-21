<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class MentorVerificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id'     => User::factory(), // otomatis buat user kalau belum ada
            'status'      => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'notes'       => $this->faker->sentence(8),
            'verified_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
