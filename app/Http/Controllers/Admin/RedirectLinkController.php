<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RedirectLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redirect_links = RedirectLink::latest('id')->paginate(15);

        return view('admin.redirect-links.index', compact('redirect_links'));
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
            'original_url' => 'required|url',
            'new_url' => 'required|url',
            'note' => 'nullable|string|max:255',
        ]);

        RedirectLink::create([
            'original_url' => $request->original_url,
            'new_url' => $request->new_url,
            'note' => $request->note,
            'added_by' => Auth::id(),
            'added_date' => now(),
        ]);

        return redirect()->route('redirect-links.index')->with('success', 'Redirect link created successfully!');
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
            'original_url' => 'required|url',
            'new_url' => 'required|url',
            'note' => 'nullable|string|max:255',
        ]);

        $link = RedirectLink::findOrFail($id);

        $link->update([
            'original_url' => $request->original_url,
            'new_url' => $request->new_url,
            'note' => $request->note,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
        ]);

        return redirect()->route('redirect-links.index')->with('success', 'Redirect link updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = RedirectLink::findOrFail($id);
        $link->delete();

        return redirect()->route('redirect-links.index')->with('success', 'Redirect link deleted successfully!');
    }
}
