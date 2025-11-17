<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Course;

class AdminModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course', 'mentor')->get();
        return view('admin.modules.index', compact('modules'));
    }

    public function delete($id)
    {
        Module::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Module deleted.');
    }
}
