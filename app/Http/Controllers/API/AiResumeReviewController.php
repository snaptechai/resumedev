<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AiReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AiResumeReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ai_resume_review(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'doc' => 'required|file|mimes:pdf,doc,docx|max:4096',
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

            $model = new AiReview;
            $model->email = $request->email;
            $model->file_path = $path;
            $model->save();

            return response()->json([
                'message' => 'CV uploaded successfully',
                'path' => Storage::url($path),
                'email' => $request->email,
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