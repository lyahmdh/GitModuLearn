<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'        => 'Admin',
            'email'       => 'admin@modulearn.com',
            'password'    => bcrypt('password'),
            'role'        => 'admin',
            'is_verified' => 1,
        ]);

        // 10 mentees
        User::factory()->count(10)->create(['role' => 'mentee']);

        // 10 mentors
        User::factory()->count(10)->create(['role' => 'mentor']);
    }
}
