<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 likes acak
        Like::factory()->count(50)->create();
    }
}
