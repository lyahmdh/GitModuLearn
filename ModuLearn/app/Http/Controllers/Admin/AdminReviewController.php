<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'module')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function delete($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Review deleted.');
    }
}
