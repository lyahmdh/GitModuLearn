<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Module;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    public function run()
    {
        Like::factory(50)->create([
            'user_id' => User::inRandomOrder()->value('id'),
            'module_id' => Module::inRandomOrder()->value('id'),
        ]);
    }
}
