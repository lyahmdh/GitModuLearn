<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submodule;

class AdminSubmoduleController extends Controller
{
    public function index()
    {
        $submodules = Submodule::with('module')->get();
        return view('admin.submodules.index', compact('submodules'));
    }

    public function delete($id)
    {
        Submodule::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Submodule deleted.');
    }
}
