<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;

class AdminCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course created.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Course updated.');
    }

    public function delete($id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Course deleted.');
    }
}
