<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'module_id' => Module::inRandomOrder()->first()->id ?? Module::factory(),
            'created_at' => now(),
        ];
    }
}
