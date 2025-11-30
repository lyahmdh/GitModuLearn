<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use App\Services\SubmoduleService;
use App\Services\SubmoduleProgressService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $moduleService;
    protected $submoduleService;

    public function __construct(ModuleService $moduleService, SubmoduleService $submoduleService, CategoryService $categoryService, SubmoduleProgressService $submoduleProgressService)
    {
        $this->moduleService = $moduleService;
        $this->submoduleService = $submoduleService;
        $this->categoryService = $categoryService;
        $this->submoduleProgressService = $submoduleProgressService;
    }

    public function index(Request $request)
    {
        $modules = $this->moduleService->getAllForLessons($request);
        $categories = $this->categoryService->getAll();
    
        return view('modules.index', compact('modules', 'categories'));
    }

    public function showModule($id)
    {
        $module = $this->moduleService->getById($id);
        $module->load('submodules');
        $module->loadCount('likes');
    
        $userId = auth()->id();
        $isLiked = \App\Models\Like::where('user_id', $userId)
                    ->where('module_id', $module->id)
                    ->exists();
    
        return view('modules.show', compact('module', 'isLiked'));
    }

    public function completeSubmodule($moduleId, $submoduleId)
    {
        // Validasi apakah submodule benar ada
        $submodule = $this->submoduleService->getById($submoduleId);

        // Panggil service progress
        $progress = app(\App\Services\SubmoduleProgressService::class)
            ->markDone(auth()->id(), $submoduleId);

        return redirect()
            ->route('pelajaran.submodule.show', [$moduleId, $submoduleId])
            ->with('success', 'Submodul ditandai selesai!');
    }

    public function showSubmodule($moduleId, $submoduleId)
    {
        $submodule = $this->submoduleService->getById($submoduleId);
    
        // ambil module dari relasi atau service
        $module = $this->moduleService->getById($moduleId);
    
        return view('submodules.show', compact('submodule', 'module'));
    }
    
    public function toggleSubmodule($moduleId, $submoduleId)
    {
        $userId = auth()->id();

        $result = $this->submoduleProgressService->toggle($userId, $submoduleId);

        return back()->with('status', $result['completed']
            ? 'Submodul ditandai selesai.'
            : 'Submodul dibatalkan penyelesaiannya.'
        );
    }

}
