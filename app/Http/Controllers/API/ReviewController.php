<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('status', 1)
            ->where('recommend_star', 5)
            ->whereRaw('CHAR_LENGTH(review) < 160')
            ->orderByDesc('added_date')
            ->limit(8)
            ->get([
                'id',
                'name',
                'review',
                'recommend_star',
                'added_date'
            ]);

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $reviews,
        ], 200);
    }
}
