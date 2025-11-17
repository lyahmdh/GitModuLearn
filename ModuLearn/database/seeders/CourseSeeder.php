<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Biologi', 'Fisika', 'Kimia',
            'Ekonomi', 'Sosiologi', 'Geografi'
        ];

        foreach ($courses as $name) {
            Course::create(['name' => $name]);
        }
    }
}
