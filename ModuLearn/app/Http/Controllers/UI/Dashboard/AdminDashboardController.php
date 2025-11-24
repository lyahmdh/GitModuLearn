<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\ModuleService;
use App\Services\CategoryService;
use App\Services\MentorVerificationService;
use App\Models\Module;

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

    /**
     * Dashboard utama admin
     */
    public function index()
    {
        $totalUsers = $this->userService->getAll()->count();
        $totalModules = $this->moduleService->getAll()->count();
        $pendingMentors = $this->verificationService->getPending()->count();

        return view('dashboard.admin.index', compact(
            'totalUsers',
            'totalModules',
            'pendingMentors'
        ));
    }

    /**
     * Tampilkan semua user
     */
    public function users()
    {
        $users = $this->userService->getAll();
        return view('dashboard.admin.users', compact('users'));
    }

    /**
     * Tampilkan semua kategori
     */
    public function categories()
    {
        $categories = $this->categoryService->getAll();
        return view('dashboard.admin.categories', compact('categories'));
    }

    /**
     * Tampilkan semua modul
     */
    public function modules()
    {
        $modules = $this->moduleService->getAll()->load('mentor', 'category');
        return view('dashboard.admin.modules', compact('modules'));
    }

    /**
     * Tampilkan request verifikasi mentor yang pending
     */
    public function mentorApproval()
    {
        $requests = $this->verificationService->getPending()->load('user');
        return view('dashboard.admin.mentor-approval', compact('requests'));
    }
}
