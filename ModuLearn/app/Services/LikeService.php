<?php

namespace App\Services;

use App\Models\Like;
use App\Models\Module;

class LikeService
{
    public function toggleLike($userId, $moduleId)
    {
        $existing = Like::where('user_id', $userId)
                        ->where('module_id', $moduleId)
                        ->first();

        if ($existing) {
            $existing->delete();

            return [
                'liked' => false,
                'message' => 'Module unliked successfully'
            ];
        }

        Like::create([
            'user_id' => $userId,
            'module_id' => $moduleId
        ]);

        return [
            'liked' => true,
            'message' => 'Module liked successfully'
        ];
    }

    public function getUserLikes(int $userId)
    {
        // Mengambil semua like user
        return Like::where('user_id', $userId)->get();
    }

    public function getModuleLikesByMentor(int $userId)
    {
        // Ambil modul yang di-like user, termasuk relasi category dan jumlah likes
        return Module::whereHas('likes', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })
        ->with('category')
        ->withCount('likes')
        ->get();
    }
}
