<?php

namespace App\Services;

use App\Models\Like;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function toggleLike(int $userId, int $moduleId): array
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
        return Module::with('category')       // ambil kategori
                     ->withCount('likes')     // tambahkan likes_count
                     ->whereHas('likes', function($q) use ($userId) {
                         $q->where('user_id', $userId); // hanya yang di-like user ini
                     })
                     ->get();
    }

    public function getModuleLikesByMentor(int $userId)
    {
        return Module::whereHas('likes', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->with('category')
            ->withCount('likes')
            ->get();
    }
}
