<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::select('id', 'question', 'answer')
            ->orderBy('id', 'desc')
            ->get();

        $faqs->map(function ($faq) {
            unset($faq->added_by);
            unset($faq->added_date);
            unset($faq->last_modified_by);
            unset($faq->last_modified_date);
        });

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $faqs,
        ], 200);
    }
}
