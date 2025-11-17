<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Course::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course added.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $course->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted.');
    }
}
