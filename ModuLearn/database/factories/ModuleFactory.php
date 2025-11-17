<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id'      => 1,
            'title'          => $this->faker->sentence(3),
            'description'    => $this->faker->paragraph(),
        ];
    }
}
