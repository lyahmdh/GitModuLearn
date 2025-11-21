<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LikeService;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggle(Request $request, $moduleId)
    {
        $userId = $request->user()->id;

        $result = $this->likeService->toggleLike($userId, $moduleId);

        return response()->json([
            'status' => 'success',
            'liked' => $result['liked'],
            'message' => $result['message']
        ]);
    }
}
