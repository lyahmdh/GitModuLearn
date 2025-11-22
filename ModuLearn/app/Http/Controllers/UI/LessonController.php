<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use App\Services\SubmoduleService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $moduleService;
    protected $submoduleService;

    public function __construct(ModuleService $moduleService, SubmoduleService $submoduleService)
    {
        $this->moduleService = $moduleService;
        $this->submoduleService = $submoduleService;
    }

    public function index(Request $request)
    {
        $modules = $this->moduleService->getAll($request);

        return view('pelajaran.index', compact('modules'));
    }

    public function showModule($id)
    {
        $module = $this->moduleService->getById($id);

        return view('pelajaran.detail', compact('module'));
    }

    public function showSubmodule($id)
    {
        $submodule = $this->submoduleService->getById($id);

        return view('pelajaran.submodul', compact('submodule'));
    }
}
