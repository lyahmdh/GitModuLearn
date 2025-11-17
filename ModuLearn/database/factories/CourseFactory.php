<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->randomElement([
                'Biologi', 'Fisika', 'Kimia',
                'Ekonomi', 'Sosiologi', 'Geografi'
            ]),
            'description' => fake()->sentence(8),
        ];
    }
}
