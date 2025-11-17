<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Course;

class ModuleFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'course_id' => Course::inRandomOrder()->first()->id,
            'mentor_id' => User::where('role', 'mentor')->inRandomOrder()->first()->id,
        ];
    }
}
