<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmoduleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('submoduls')->insert([
            [
                'modules_id'   => 1,
                'title'        => 'Submodul 1',
                'content_type' => 'pdf', // HARUS 'pdf' atau 'video'
                'content_url'  => 'https://example.com/file1.pdf',
                'order'        => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
                'deleted_at'   => null,
            ],
            [
                'modules_id'   => 1,
                'title'        => 'Submodul 2',
                'content_type' => 'video',
                'content_url'  => 'https://example.com/video1.mp4',
                'order'        => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
                'deleted_at'   => null,
            ],
        ]);
    }
}
