<?php

namespace App\Services;

use App\Models\Like;

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
}
