<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MentorVerificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id'   => null, // akan dioverride di seeder
            'file_path' => 'uploads/docs/' . $this->faker->uuid() . '.pdf',
            'status'    => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
