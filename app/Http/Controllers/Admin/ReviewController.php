<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $pendingReviews = Review::where('status', '0')->orderByDesc('added_date')->get();
        $approvedReviews = Review::where('status', '1')->orderByDesc('added_date')->get();
        $rejectedReviews = Review::where('status', '2')->orderByDesc('added_date')->get();

        return view('admin.reviews.index', compact('pendingReviews', 'approvedReviews', 'rejectedReviews'));
    }

    public function create()
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->status = $request->status;
            $review->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->route('reviews.index')->with('error', 'Review successfully Removed.');
    }
}
