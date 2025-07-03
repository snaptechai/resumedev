<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiReview;
use Illuminate\Http\Request;

class AiReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aiReviews = AiReview::orderBy('id', 'desc')->paginate(10);

        return view('admin.ai-review.index', compact('aiReviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $review = AiReview::findOrFail($id);
        $is_sent = $request->has('is_sent') ? 1 : 0;
        $review->update([
            $review->description = $request->description,
            $review->is_sent = $is_sent,
        ]);
        if ($is_sent == 1) {
            # send e-mail
        }
 
        return redirect()->back()->with('success', 'AI Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}