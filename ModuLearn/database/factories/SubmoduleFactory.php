<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmoduleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'module_id' => Module::factory(),
            'title' => $this->faker->sentence(),
            'content_type' => $this->faker->randomElement(['pdf','doc','ppt','video','text']),
            'content_url' => $this->faker->url(),
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
