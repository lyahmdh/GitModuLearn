<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ModuleService;
use App\Services\SubmoduleService;
use App\Services\LikeService;
use App\Services\CategoryService;

class MentorDashboardController extends Controller
{
    protected $moduleService;
    protected $submoduleService;
    protected $likeService;
    protected $categoryService;

    public function __construct(
        ModuleService $moduleService,
        SubmoduleService $submoduleService,
        LikeService $likeService,
        CategoryService $categoryService
    ) {
        $this->moduleService = $moduleService;
        $this->submoduleService = $submoduleService;
        $this->likeService = $likeService;
        $this->categoryService = $categoryService;
    }

    /**
     * Dashboard utama mentor
     */
    public function index()
    {
        $mentorId = Auth::id();

        // Ambil semua modul mentor beserta jumlah submodules dan likes
        $modules = $this->moduleService->getModulesByMentor($mentorId);

        $totalModules = $modules->count();
        $totalLikes = $modules->sum('likes_count');
        $totalSubmodules = $modules->sum(function ($mod) {
            return $mod->submodules->count();
        });

        return view('dashboard.mentor.index', compact(
            'modules',
            'totalModules',
            'totalLikes',
            'totalSubmodules'
        ));
    }

    /**
     * Menampilkan semua modul mentor
     */
    // public function modules()
    // {
    //     $modules = $this->moduleService->getAll(); // semua modul atau sesuai logikamu
    //     return view('dashboard.mentor.modules.index', compact('modules'));
    // }
    
    public function myModules()
    {
        $modules = $this->moduleService->getModulesByMentor(Auth::id());
        return view('dashboard.mentor.modules.my-modules', compact('modules'));
    }
    
    

    /**
     * Halaman create modul baru
     */
    public function createModule()
    {
        $categories = $this->categoryService->getAll(); // ambil semua kategori
        return view('dashboard.mentor.modules.create-module', compact('categories'));
    }
    

    /**
     * Halaman edit modul
     */
    public function editModule($id)
    {
        $module = $this->moduleService->getById($id);

        return view('dashboard.mentor.modules.edit-module', compact('module'));
    }

    /**
     * Lihat semua likes dari modul mentor
     */
    // public function likes()
    // {
    //     $modules = $this->moduleService->getModulesByMentor(Auth::id());
    //     $totalLikes = $modules->sum('likes_count');

    //     return view('dashboard.mentor.likes', compact('modules', 'totalLikes'));
    // }

    public function likedModules()
    {
        $likedModules = $this->likeService->getModuleLikesByMentor(Auth::id());
        return view('dashboard.mentor.likes', compact('likedModules'));
    }
    
    

    public function editProfile()
    {
        return view('dashboard.mentor.profile', ['user' => Auth::user()]);
    }
}
