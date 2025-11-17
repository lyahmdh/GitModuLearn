<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Course;

class MentorModuleController extends Controller
{
    public function index()
    {
        $modules = Module::where('mentor_id', auth()->id())->get();
        return view('mentor.modules.index', compact('modules'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('mentor.modules.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        Module::create([
            'mentor_id' => auth()->id(),
            'course_id' => $request->course_id,
            'title'    => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Module created.');
    }

    public function edit($id)
    {
        $module = Module::where('mentor_id', auth()->id())->findOrFail($id);
        $courses = Course::all();

        return view('mentor.modules.edit', compact('module', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $module = Module::where('mentor_id', auth()->id())->findOrFail($id);

        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $module->update($request->only('course_id', 'title', 'description'));

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Module updated.');
    }

    public function delete($id)
    {
        $module = Module::where('mentor_id', auth()->id())->findOrFail($id);
        $module->delete();

        return redirect()->back()->with('success', 'Module deleted.');
    }
}
