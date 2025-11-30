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
        return \App\Models\Like::where('user_id', $userId)
            ->pluck('module_id')
            ->toArray();
    }

    public function getUserProgressList($userId)
    {
        $progressList = SubmoduleProgress::with('submodule.module') // eager load module
            ->where('user_id', $userId)
            ->get()
            ->map(function($progress) {
                $module = $progress->submodule->module;
                if (!$module) return null; // skip jika module null
    
                $totalSubmodules = $module->submodules->count();
                $completedSubmodules = $module->submodules->where('id', '<=', $progress->submodule_id)->count(); // contoh logika
                $progressPercentage = $totalSubmodules > 0 ? round($completedSubmodules / $totalSubmodules * 100) : 0;
    
                return [
                    'module' => $module,
                    'completed' => $completedSubmodules,
                    'total' => $totalSubmodules,
                    'progress' => $progressPercentage,
                ];
            })
            ->filter() // buang elemen null
            ->unique('module.id') // hapus duplikat module
            ->values();
    
        return $progressList;
    }
    

    /**
     *  NEW: Toggle progress (done <-> undone)
     */
    public function toggle(int $userId, int $submoduleId)
    {
        $existing = SubmoduleProgress::where('user_id', $userId)
            ->where('submodule_id', $submoduleId)
            ->first();

        if ($existing) {
            // Jika sudah selesai → batalkan
            $existing->delete();
            return ['completed' => false];
        }

        // Jika belum ada → tandai selesai
        $progress = SubmoduleProgress::create([
            'user_id' => $userId,
            'submodule_id' => $submoduleId,
            'status' => 'done',
        ]);

        return [
            'completed' => true,
            'data' => $progress
        ];
    }
}
