<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        \App\Models\User::factory()->admin()->create([
            'email' => 'admin@modulearn.com',
        ]);

        // Mentors
        \App\Models\User::factory()->count(5)->mentor()->create();

        // Mentees
        \App\Models\User::factory()->count(10)->mentee()->create();

        // Courses
        \App\Models\Course::factory()->count(6)->create();

        // Modules
        \App\Models\Module::factory()->count(10)->create();

        // Submodules
        \App\Models\Submodule::factory()->count(30)->create();

        // Mentor verification docs
        \App\Models\MentorVerification::factory()->count(5)->create();

        // Likes
        \App\Models\ModuleLike::factory()->count(20)->create();

        // Progress
        \App\Models\ModuleProgress::factory()->count(40)->create();

        // Admin logs
        \App\Models\ActivityLog::factory()->count(15)->create();
    }
}
