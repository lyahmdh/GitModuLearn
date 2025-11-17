<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Module;

class MentorReviewController extends Controller
{
    public function index()
    {
        $modules = Module::where('mentor_id', auth()->id())->pluck('id');

        $reviews = Review::whereIn('module_id', $modules)
            ->with('user', 'module')
            ->get();

        return view('mentor.reviews.index', compact('reviews'));
    }
}
