<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;

class SubmoduleFactory extends Factory
{
    public function definition()
    {
        $type = fake()->randomElement(['pdf', 'video']);

        return [
            'module_id' => Module::inRandomOrder()->first()->id,
            'title' => fake()->sentence(3),
            'content_type' => $type,
            'content_url' => $type === 'pdf'
                ? 'uploads/pdf/sample.pdf'
                : 'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ];
    }
}
