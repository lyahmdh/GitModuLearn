<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Submodule;

class PublicSubmoduleController extends Controller
{
    public function show($id)
    {
        $submodule = Submodule::findOrFail($id);

        return view('web.submodule-show', compact('submodule'));
    }
}
