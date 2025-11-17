<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\Submodule;
use App\Models\Progress;

class MenteeSubmoduleController extends Controller
{
    public function show($id)
    {
        $submodule = Submodule::with('module')->findOrFail($id);
        return view('mentee.submodules.show', compact('submodule'));
    }

    public function markDone($id)
    {
        $submodule = Submodule::findOrFail($id);

        Progress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'submodule_id' => $id
            ],
            ['is_done' => true]
        );

        return redirect()->back()->with('success', 'Marked as completed.');
    }
}
