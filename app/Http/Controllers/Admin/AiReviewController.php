<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiReview;
use Illuminate\Http\Request;
use App\Mail\ReviewSentMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\ProcessAiResumeReview;

class AiReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = AiReview::query()->orderBy('id', 'desc');

        if ($filter === 'sent') {
            $query->where('is_sent', true);
        } elseif ($filter === 'not_sent') {
            $query->where('is_sent', false);
        }

        $aiReviews = $query->paginate(10);
        $aiReviews->appends(['filter' => $filter]);

        return view('admin.ai-review.index', compact('aiReviews', 'filter'));
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
        $aiReview = AiReview::findOrFail($id);
        return view('admin.ai-review.edit', compact('aiReview'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $review = AiReview::findOrFail($id);

        $is_sent = $request->has('is_sent') ? 1 : 0;

        $review->update([
            'description' => $request->description,
            'is_sent' => $is_sent,
        ]);

        // if ($is_sent == 1 && $review->email) {
        //     Mail::to($review->email)->queue(new ReviewSentMail($request->description));
        // }

        return redirect()->back()->with('success', 'AI Review updated successfully!');
    }

    public function regenerate(string $id)
    {
        $review = AiReview::findOrFail($id);

        $review->update(['is_sent' => false]);

        ProcessAiResumeReview::dispatch($review);

        return redirect()->back()->with('success', 'AI Review regeneration started. This may take a few minutes.');
    }

    public function sendEmail(string $id)
    {
        $review = AiReview::findOrFail($id);

        if (!$review->email) {
            return redirect()->back()->with('error', 'No email address found for this review.');
        }

        if (!$review->description) {
            return redirect()->back()->with('error', 'Review description is empty. Cannot send email.');
        }

        Mail::to($review->email)->queue(new ReviewSentMail($review->description));

        $review->update(['is_sent' => true]);

        return redirect()->back()->with('success', 'Review email sent successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
