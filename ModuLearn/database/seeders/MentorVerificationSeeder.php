<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MentorVerification;
use App\Models\User;

class MentorVerificationSeeder extends Seeder
{
    public function run()
    {
        $mentors = User::where('role', 'mentor')->get();

        foreach ($mentors as $mentor) {
            MentorVerification::factory()->create([
                'user_id' => $mentor->id,
                'status'  => 'approved',
            ]);
        }
    }
}
