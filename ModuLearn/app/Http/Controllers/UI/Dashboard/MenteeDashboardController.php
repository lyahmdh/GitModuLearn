<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use App\Services\LikeService;
use App\Services\ProgressService;
use Illuminate\Support\Facades\Auth;

class MenteeDashboardController extends Controller
{
    protected $moduleService;
    protected $likeService;
    protected $progressService;

    public function __construct(ModuleService $moduleService, LikeService $likeService, ProgressService $progressService)
    {
        $this->moduleService = $moduleService;
        $this->likeService = $likeService;
        $this->progressService = $progressService;
    }

    public function index()
    {
        $user = Auth::user();

        $progress = $this->progressService->getUserProgress($user->id);

        return view('dashboard.mentee.index', compact('user', 'progress'));
    }

    public function likedModules()
    {
        $liked = $this->likeService->getUserLikes(Auth::id());

        return view('dashboard.mentee.likes', compact('liked'));
    }

    public function progress()
    {
        $progress = $this->progressService->getUserProgress(Auth::id());

        return view('dashboard.mentee.progress', compact('progress'));
    }

    public function editProfile()
    {
        return view('dashboard.mentee.profile.edit', ['user' => Auth::user()]);
    }
}
