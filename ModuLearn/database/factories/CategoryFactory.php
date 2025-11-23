<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika',
                'Kimia', 'Biologi', 'Ekonomi', 'Geografi', 'Sosiologi',
                'Sejarah', 'Informatika', 'Seni Budaya'
            ]),
        ];
    }
}
