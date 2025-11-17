<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Submodule;

class ModuleProgressFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::where('role', 'mentee')->inRandomOrder()->first()->id,
            'submodule_id' => Submodule::inRandomOrder()->first()->id,
            'status' => fake()->randomElement(['done', 'in-progress']),
        ];
    }
}
