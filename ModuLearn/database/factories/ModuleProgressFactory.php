<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleProgressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'   => 1,
            'module_id' => 1,
            'progress'  => $this->faker->numberBetween(0, 100),
            'status'    => $this->faker->randomElement(['in_progress', 'completed']),
        ];
    }
}
