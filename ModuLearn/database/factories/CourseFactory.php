<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Biologi', 'Fisika', 'Kimia', 'Ekonomi', 'Sosiologi', 'Geografi'
            ]),
        ];
    }
}
