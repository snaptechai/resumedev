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
        $redirect_links = RedirectLink::paginate(10);

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
        RedirectLink::create([
            'original_url' => $request->original_url,
            'new_url' => $request->new_url,
            'note' => $request->note,
            'added_by' => Auth::id(),
            'added_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Redirect Link created successfully!');

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
        $link = RedirectLink::findOrFail($id);

        $link->update([
            'original_url' => $request->original_url,
            'new_url' => $request->new_url,
            'note' => $request->note,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Redirect Link Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $link = RedirectLink::findOrFail($id);

        $link->delete();

        return redirect()->back()->with('success', 'Redirect Link Deleted successfully!');
    }
}
