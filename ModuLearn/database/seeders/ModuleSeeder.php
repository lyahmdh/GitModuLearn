<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\User;
use App\Models\Course;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        // ambil mentor yang sudah terverifikasi
        $mentor = User::where('role', 'mentor')
            ->where('is_verified', 1)
            ->first();

        // kalau belum ada mentor verified → hentikan seeding
        if (!$mentor) {
            throw new \Exception("Tidak ada mentor terverifikasi. Jalankan UserSeeder dulu.");
        }

        // ambil semua course
        $courses = Course::all();

        foreach ($courses as $course) {
            Module::create([
                'course_id'   => $course->id,
                'mentor_id'   => $mentor->id,
                'title'       => 'Modul ' . $course->name,
                'description' => 'Deskripsi modul untuk pelajaran ' . $course->name,
            ]);
        }
    }
}
