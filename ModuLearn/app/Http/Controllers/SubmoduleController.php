<?php

namespace App\Http\Controllers;

use App\Models\Submodule;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Services\SubmoduleService;

class SubmoduleController extends Controller
{
    protected $service;

    public function __construct(SubmoduleService $service)
    {
        $this->service = $service;
    }

    public function index(Module $module)
    {
        return response()->json([
            'data' => $this->service->getByModule($module)
        ]);
    }

    public function store(Request $request, Module $module)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content_type' => 'required|in:pdf,doc,ppt,video,text',
            'content_url' => 'required|string',
            'order' => 'required|integer',
        ]);

        $data['module_id'] = $module->id;

        $submodule = $this->service->create($data);

        return response()->json([
            'message' => 'Submodule created',
            'data' => $submodule
        ], 201);
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
