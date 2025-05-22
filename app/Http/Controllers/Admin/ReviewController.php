<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Review::query()->orderByDesc('added_date');

        if ($filter === 'pending') {
            $query->where('status', '0');
        } elseif ($filter === 'approved') {
            $query->where('status', '1');
        } elseif ($filter === 'rejected') {
            $query->where('status', '2');
        }

        $reviews = $query->paginate(10);
        $reviews->appends(['filter' => $filter]);

        return view('admin.reviews.index', compact('reviews', 'filter'));
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
