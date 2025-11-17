<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MentorDocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'   => 1,
            'type'      => 'certificate',
            'file_path' => 'uploads/documents/dummy.pdf',
        ];
    }
}
