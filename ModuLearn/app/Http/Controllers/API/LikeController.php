<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\LikeService;
use App\Http\Controllers\Controller;
use App\Models\Like;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggle($id)
    {
        $userId = auth()->id();
    
        $existing = Like::where('user_id', $userId)
                        ->where('module_id', $id)
                        ->first();
    
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $userId,
                'module_id' => $id,
            ]);
            $liked = true;
        }
    
        $likesCount = Like::where('module_id', $id)->count();
    
        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount,
        ]);
    }
    

    public function toggleLike($userId, $moduleId)
    {
        $like = Like::where('user_id', $userId)
                    ->where('module_id', $moduleId)
                    ->first();
    
        if ($like) {
            $like->delete();
            return ['liked' => false, 'message' => 'Unliked'];
        }
    
        Like::create([
            'user_id' => $userId,
            'module_id' => $moduleId
        ]);
    
        return ['liked' => true, 'message' => 'Liked'];
    }
        
    
}
