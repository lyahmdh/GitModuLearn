<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ActivityLogFactory extends Factory
{
    public function definition()
    {
        return [
            'admin_id' => User::where('role', 'admin')->inRandomOrder()->first()->id,
            'action' => fake()->sentence(3),
            'details' => fake()->sentence(8),
        ];
    }
}
