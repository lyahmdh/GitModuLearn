<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    protected $service;

    public function __construct(ModuleService $service)
    {
        $this->service = $service;
    }

    // Tampilkan semua modul untuk admin dashboard
    public function index(Request $request)
    {
        $modules = $this->service->getAll();

        return view('dashboard.admin.modules', compact('modules'));
    }

    /**
     * Simpan modul baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'thumbnail' => 'required|image|max:2048',
        ]);

        // Upload thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        // Simpan modul via service
        $module = $this->service->createModule([
            'mentor_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('dashboard.mentor.modules.my-modules')
                         ->with('success', 'Modul berhasil dibuat!');
    }

    // Hapus modul
    public function destroy(Module $module, Request $request)
    {
        try {
            $this->service->delete($module);

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Modul berhasil dihapus']);
            }

            return redirect()->back()->with('success', 'Modul berhasil dihapus!');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Gagal menghapus modul', 'error' => $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Gagal menghapus modul: ' . $e->getMessage());
        }
    }
}
