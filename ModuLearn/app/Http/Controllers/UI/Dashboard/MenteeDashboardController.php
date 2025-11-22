<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use App\Services\LikeService;
use App\Services\SubmoduleProgressService;
use Illuminate\Support\Facades\Auth;

class MenteeDashboardController extends Controller
{
    protected $moduleService;
    protected $likeService;
    protected $SubmoduleProgressService;

    public function __construct(ModuleService $moduleService, LikeService $likeService, SubmoduleProgressService $SubmoduleProgressService)
    {
        $this->moduleService = $moduleService;
        $this->likeService = $likeService;
        $this->SubmoduleProgressService = $SubmoduleProgressService;
    }

    public function index()
    {
        $user = Auth::user();

        $progress = $this->SubmoduleProgressService->getUserProgress($user->id);

        // Ambil list modul yang disukai user
        $liked = $this->SubmoduleProgressService->getUserLikes($user->id);
        $totalLiked = count($liked); // jumlah modul disukai


        return view('dashboard.mentee.index', [
            'user' => $user,
            'totalModules' => $progress['total'],
            'totalCompleted' => $progress['done'],
            'percentCompleted' => $progress['percent'],
            'totalLiked' => $totalLiked,
        ]);
    }

    public function likedModules(LikeService $likeService)
    {
        // Fetch liked modules for the current user
        $likedModules = $likeService->getUserLikes(auth()->user()->id);
    
        // Pass the data to the view
        return view('dashboard.mentee.likes', compact('likedModules'));
    }

    public function progress()
    {
        $progressList = $this->SubmoduleProgressService->getUserProgressList(Auth::id());
    
        return view('dashboard.mentee.progress', compact('progressList'));
    }
    

    public function editProfile()
    {
        return view('dashboard.mentee.profile.edit', ['user' => Auth::user()]);
    }
}
