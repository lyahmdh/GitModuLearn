<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title'   => $this->faker->sentence(3),
            'message' => $this->faker->sentence(10),
            'is_read' => false,
        ];
    }
}
