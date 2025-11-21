<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Submodule;

class SubmoduleSeeder extends Seeder
{
    public function run(): void
    {
        // setiap module memiliki 3–6 submodule
        Module::all()->each(function ($module) {
            Submodule::factory()
                ->count(rand(3,6))
                ->create([
                    'module_id' => $module->id
                ]);
        });
    }
}
