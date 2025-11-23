<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Submodule;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmoduleProgressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'submodule_id' => Submodule::factory(),
            'status' => 'done',
        ];
    }
}
