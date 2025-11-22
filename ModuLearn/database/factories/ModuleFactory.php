<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mentor_id' => User::where('role', 'mentor')->inRandomOrder()->first()->id
                ?? User::factory()->create(['role' => 'mentor'])->id,

            'category_id' => Category::inRandomOrder()->first()->id
                ?? Category::factory()->create()->id,

            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
