<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Submodule;
use App\Models\SubmoduleProgress;

class SubmoduleProgressSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'mentee')->get();

        foreach ($users as $user) {

            // mereka menyelesaikan 20–40 submodule random
            $submodules = Submodule::inRandomOrder()->limit(rand(20,40))->get();

            foreach ($submodules as $submodule) {
                SubmoduleProgress::factory()->create([
                    'user_id' => $user->id,
                    'submodule_id' => $submodule->id,
                    'status' => 'done',
                ]);
            }
        }
    }
}
