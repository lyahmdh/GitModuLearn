<?php

namespace App\Http\Controllers\UI\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 
use App\Services\ModuleService;
use App\Services\SubmoduleService;
use App\Services\SubmoduleProgressService;
use App\Services\LikeService;
use App\Services\CategoryService;
use App\Models\Module;
use App\Models\Category;

class MentorDashboardController extends Controller
{
    protected $moduleService;
    protected $submoduleService;
    protected $likeService;
    protected $categoryService;
    protected $submoduleProgressService;

    public function __construct(
        ModuleService $moduleService,
        SubmoduleService $submoduleService,
        LikeService $likeService,
        CategoryService $categoryService,
        SubmoduleProgressService $SubmoduleProgressService
    ) {
        $this->moduleService = $moduleService;
        $this->submoduleService = $submoduleService;
        $this->likeService = $likeService;
        $this->categoryService = $categoryService;
        $this->SubmoduleProgressService = $SubmoduleProgressService;
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
        $module = Module::findOrFail($id);
        $categories = Category::all(); // <— WAJIB
    
        return view('dashboard.mentor.modules.edit-module', compact('module', 'categories'));
    }

    public function updateModule(Request $request, $id)
    {
        $module = Module::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $module->update($data);

        return redirect()
            ->route('dashboard.mentor.modules.my-modules')
            ->with('success', 'Modul berhasil diperbarui!');
    }

    public function storeModule(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048', // opsional
        ]);
    
        // Upload thumbnail bila ada
        if ($request->hasFile('thumbnail')) {
            // simpan file ke storage/app/public/thumbnails
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
    
        $data['mentor_id'] = Auth::id();
    
        Module::create($data);
    
        return redirect()
            ->route('dashboard.mentor.modules.my-modules')
            ->with('success', 'Modul berhasil dibuat!');
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

    public function progress()
    {
        $progressList = $this->SubmoduleProgressService->getUserProgressList(Auth::id());
    
        return view('dashboard.mentor.progress', compact('progressList'));
    }    

}
