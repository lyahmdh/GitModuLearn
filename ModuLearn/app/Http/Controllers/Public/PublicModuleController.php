<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Submodule;

class PublicModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course')->paginate(12);
        return view('web.modules', compact('modules'));
    }

    public function show($id)
    {
        $module = Module::with('mentor')->findOrFail($id);
        $submodules = Submodule::where('module_id', $id)->get();

        return view('web.module-show', compact('module', 'submodules'));
    }
}
