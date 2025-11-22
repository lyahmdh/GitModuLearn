<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\ModuleService;
use App\Services\CategoryService;
use App\Services\MentorVerificationService;

class AdminDashboardController extends Controller
{
    protected $userService;
    protected $moduleService;
    protected $categoryService;
    protected $verificationService;

    public function __construct(
        UserService $userService,
        ModuleService $moduleService,
        CategoryService $categoryService,
        MentorVerificationService $verificationService
    ) {
        $this->userService = $userService;
        $this->moduleService = $moduleService;
        $this->categoryService = $categoryService;
        $this->verificationService = $verificationService;
    }

    public function index()
    {
        return view('dashboard.admin.index');
    }

    public function users()
    {
        $users = $this->userService->getAll();

        return view('dashboard.admin.users.index', compact('users'));
    }

    public function categories()
    {
        $categories = $this->categoryService->getAll();

        return view('dashboard.admin.categories.index', compact('categories'));
    }

    public function modules()
    {
        $modules = $this->moduleService->getAll([]);

        return view('dashboard.admin.modules.index', compact('modules'));
    }

    public function mentorApproval()
    {
        $pending = $this->verificationService->getPending();

        return view('dashboard.admin.mentors.pending', compact('pending'));
    }
}
