<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use App\Services\SubmoduleService;
use App\Services\LikeService;
use Illuminate\Support\Facades\Auth;

class MentorDashboardController extends Controller
{
    protected $moduleService;
    protected $submoduleService;
    protected $likeService;

    public function __construct(ModuleService $moduleService, SubmoduleService $submoduleService, LikeService $likeService)
    {
        $this->moduleService = $moduleService;
        $this->submoduleService = $submoduleService;
        $this->likeService = $likeService;
    }

    public function index()
    {
        $modules = $this->moduleService->getModulesByMentor(Auth::id());

        return view('dashboard.mentor.index', compact('modules'));
    }

    public function modules()
    {
        $modules = $this->moduleService->getModulesByMentor(Auth::id());

        return view('dashboard.mentor.modules.index', compact('modules'));
    }

    public function createModule()
    {
        return view('dashboard.mentor.modules.create');
    }

    public function editModule($id)
    {
        $module = $this->moduleService->getById($id);

        return view('dashboard.mentor.modules.edit', compact('module'));
    }

    public function likes()
    {
        $likes = $this->likeService->getModuleLikesByMentor(Auth::id());

        return view('dashboard.mentor.likes', compact('likes'));
    }
}
