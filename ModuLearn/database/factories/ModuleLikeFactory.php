<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;
use App\Models\User;

class ModuleLikeFactory extends Factory
{
    public function definition()
    {
        return [
            'module_id' => Module::inRandomOrder()->first()->id,
            'user_id' => User::where('role', 'mentee')->inRandomOrder()->first()->id,
        ];
    }
}
