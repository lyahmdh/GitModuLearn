<?php

namespace App\Http\Controllers\API;

use App\Models\Submodule;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Services\SubmoduleService;
use App\Http\Controllers\Controller;

class SubmoduleController extends Controller
{
    protected $service;

    public function __construct(SubmoduleService $service)
    {
        $this->service = $service;
    }

    /**
     * Tampilkan form buat submodule baru
     */
    public function create(Module $module)
    {
        return view('dashboard.mentor.submodules.create', compact('module'));
    }

    /**
     * Simpan submodule baru
     */
    public function store(Request $request, Module $module)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:pdf,doc,ppt,video,text',
            'content_url' => 'required|string',
            'order' => 'required|integer',
        ]);

        $submodule = Submodule::create([
            'module_id' => $module->id,
            'title' => $request->title,
            'content_type' => $request->content_type,
            'content_url' => $request->content_url,
            'order' => $request->order,
        ]);

        return redirect()->route('dashboard.mentor.submodules.index', $module->id)
                         ->with('success', 'Submodule berhasil dibuat!');
    }

    /**
     * Daftar semua submodules dari modul tertentu
     */
    public function index(Module $module)
    {
        $submodules = $module->submodules()->orderBy('order')->get();
        return view('dashboard.mentor.submodules.index', compact('module', 'submodules'));
    }
    

    public function update(Request $request, Submodule $submodule)
    {
        $data = $request->validate([
            'title' => 'string',
            'content_type' => 'in:pdf,doc,ppt,video,text',
            'content_url' => 'string',
            'order' => 'integer',
        ]);

        $updated = $this->service->update($submodule, $data);

        return response()->json([
            'message' => 'Submodule updated',
            'data' => $updated
        ]);
    }

    public function destroy(Submodule $submodule)
    {
        $this->service->delete($submodule);

        return response()->json([
            'message' => 'Submodule deleted'
        ]);
    }
}
