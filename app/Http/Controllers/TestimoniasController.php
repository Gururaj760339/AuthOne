<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimoniasController extends Controller
{

    public function storeReview(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('reviews', 'public');
        }

        Testimonial::create([
            'name' => $request->name,
            'location' => $request->location,
            'rating' => $request->rating,
            'review' => $request->review,
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function adminReviewShow()
    {
        $reviews = Testimonial::latest()->get();

        return view('admin.reviews.admin_review_show', compact('reviews'));
    }

    public function adminReviewDelete($id)
    {
        $review = Testimonial::findOrFail($id);

        // Delete image if exists
        if ($review->image && file_exists(public_path($review->image))) {
            unlink(public_path($review->image));
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
