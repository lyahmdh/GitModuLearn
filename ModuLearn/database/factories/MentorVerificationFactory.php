<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class MentorVerificationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::where('role', 'mentor')->inRandomOrder()->first()->id,
            'document_path' => 'uploads/verifications/sample_document.pdf',
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
