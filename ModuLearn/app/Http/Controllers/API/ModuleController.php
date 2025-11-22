<?php

namespace App\Http\Controllers\API;
use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $service;

    public function __construct(ModuleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->service->store($validated));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->service->update($module, $validated));
    }

    public function destroy(Module $module)
    {
        return response()->json($this->service->delete($module));
    }
}
