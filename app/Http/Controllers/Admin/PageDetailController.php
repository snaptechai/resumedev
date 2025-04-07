<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageDetails = PageDetail::all();

        return view('admin.page-details.index', [
            'pageDetails' => $pageDetails,
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
        $request->validate([
            'content' => 'required',
        ]);

        $pageDetail = PageDetail::findOrFail($id);

        $pageDetail->update([
            'content' => $request->content,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
        ]);

        return redirect()->route('page-details.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
