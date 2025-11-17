<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Course;

class MenteeModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course', 'mentor')->paginate(12);
        return view('mentee.modules.index', compact('modules'));
    }

    public function category($courseId)
    {
        $course = Course::findOrFail($courseId);
        $modules = Module::where('course_id', $courseId)->get();

        return view('mentee.modules.category', compact('course', 'modules'));
    }

    public function show($id)
    {
        $module = Module::with('course', 'mentor', 'submodules')->findOrFail($id);

        return view('mentee.modules.show', compact('module'));
    }
}
