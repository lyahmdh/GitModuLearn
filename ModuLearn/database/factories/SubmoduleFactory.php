<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubmoduleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'module_id'      => 1,
            'title'          => $this->faker->sentence(3),
            'content'        => $this->faker->paragraph(5),
        ];
    }
}
