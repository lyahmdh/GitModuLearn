<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Services\SubmoduleProgressService;

class SubmoduleProgressController extends Controller
{
    protected $service;

    public function __construct(SubmoduleProgressService $service)
    {
        $this->service = $service;
    }

    public function markAsDone(Request $request)
    {
        $data = $request->validate([
            'submodule_id' => 'required|exists:submodules,id',
        ]);

        $progress = $this->service->markDone(
            auth()->id(),
            $data['submodule_id']
        );

        return response()->json([
            'message' => 'Progress updated',
            'data' => $progress
        ]);
    }
}
