<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', [
            'tags' => $tags,
        ]);
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
        $request->validate([
            'tag' => 'required|string|max:255|unique:tag,tag',
        ]);

        Tag::create([
            'tag' => $request->tag,
            'added_by' => Auth::id(),
            'added_date' => now(),
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
        ]);

        return redirect()->route('tags.index');
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
        $request->validate([
            'tag' => 'required|string|max:255|unique:tag,tag,'.$id,
        ]);

        $tag = Tag::findOrFail($id);

        $tag->update([
            'tag' => $request->tag,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
        ]);

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return redirect()->route('tags.index');
    }
}
