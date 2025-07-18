<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessAiResumeReview;
use App\Models\AiReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AiResumeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function uploadResume(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'doc' => 'required|file|mimes:pdf,docx|max:4096',
        ], [
            'doc.mimes' => 'Only PDF and DOCX files are supported for resume review.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->hasFile('doc')) {
            $file = $request->file('doc');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('cv_uploads', $filename, 'public');

            $aiReview = AiReview::create([
                'email' => $request->email,
                'file_path' => $path,
                'description' => null,
                'is_sent' => false
            ]);

            ProcessAiResumeReview::dispatch($aiReview);

            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'message' => 'CV uploaded successfully.',
            ]);
        }

        return response()->json(['message' => 'File not uploaded'], 400);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
