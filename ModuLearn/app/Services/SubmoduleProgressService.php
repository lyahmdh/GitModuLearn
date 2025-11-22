<?php

namespace App\Services;

use App\Models\SubmoduleProgress;

class SubmoduleProgressService
{
    public function markDone(int $userId, int $submoduleId)
    {
        return SubmoduleProgress::updateOrCreate(
            [
                'user_id' => $userId,
                'submodule_id' => $submoduleId
            ],
            [
                'status' => 'done'
            ]
        );
    }

    public function getUserProgress(int $userId): array
    {
        $totalDone = SubmoduleProgress::where('user_id', $userId)
            ->where('status', 'done')
            ->count();

        $totalSubmodules = SubmoduleProgress::where('user_id', $userId)->count();

        $percent = $totalSubmodules > 0 ? ($totalDone / $totalSubmodules) * 100 : 0;

        return [
            'done' => $totalDone,
            'total' => $totalSubmodules,
            'percent' => $percent,
        ];
    }

    public function getUserLikes(int $userId): array
    {
        // Ambil list module_id yang disukai user
        return \App\Models\Like::where('user_id', $userId)
            ->pluck('module_id')
            ->toArray();
    }

    
    public function getUserProgressList(int $userId)
    {
        return SubmoduleProgress::with('submodule') // relasi ke submodule
            ->where('user_id', $userId)
            ->get();
    }   

}
