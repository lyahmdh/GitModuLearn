<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submodule;
use App\Models\Module;

class MentorSubmoduleController extends Controller
{
    public function index($moduleId)
    {
        $module = Module::where('mentor_id', auth()->id())->findOrFail($moduleId);
        $submodules = Submodule::where('module_id', $moduleId)->get();

        return view('mentor.submodules.index', compact('module', 'submodules'));
    }

    public function create($moduleId)
    {
        $module = Module::where('mentor_id', auth()->id())->findOrFail($moduleId);
        return view('mentor.submodules.create', compact('module'));
    }

    public function store(Request $request, $moduleId)
    {
        $request->validate([
            'title' => 'required|string',
            'type'  => 'required|in:pdf,video',
            'file_url' => 'required|string'
        ]);

        Submodule::create([
            'module_id' => $moduleId,
            'title' => $request->title,
            'type' => $request->type,
            'file_url' => $request->file_url,
        ]);

        return redirect()->route('mentor.submodules.index', $moduleId)
            ->with('success', 'Submodule created.');
    }

    public function edit($moduleId, $id)
    {
        $module = Module::where('mentor_id', auth()->id())->findOrFail($moduleId);
        $submodule = Submodule::findOrFail($id);

        return view('mentor.submodules.edit', compact('module', 'submodule'));
    }

    public function update(Request $request, $moduleId, $id)
    {
        $submodule = Submodule::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'type'  => 'required|in:pdf,video',
            'file_url' => 'required|string'
        ]);

        $submodule->update($request->only('title', 'type', 'file_url'));

        return redirect()->route('mentor.submodules.index', $moduleId)
            ->with('success', 'Submodule updated.');
    }

    public function delete($moduleId, $id)
    {
        $submodule = Submodule::findOrFail($id);
        $submodule->delete();

        return redirect()->back()->with('success', 'Submodule deleted.');
    }
}
