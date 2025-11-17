<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;

class CourseController extends Controller
{
    public function index()
    {
        $categories = Course::all();
        return view('web.category-list', compact('categories'));
    }

    public function show($id)
    {
        $category = Course::findOrFail($id);
        $modules = Module::where('course_id', $id)->get();

        return view('web.category-modules', compact('category', 'modules'));
    }
}
