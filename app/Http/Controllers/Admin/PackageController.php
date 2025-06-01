<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::latest('id')->paginate(15);

        return view('admin.packages.index', compact('packages'));
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
        $package = Package::findOrFail($id);

        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'europe_price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'europe_old_price' => 'nullable|numeric',
            'duration' => 'required|string|max:255',
        ]);

        $package = Package::findOrFail($id);

        $package->update([
            'title' => $request->title,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
            'full_description' => $request->full_description,
            'europe_price' => $request->europe_price,
            'old_price' => $request->old_price,
            'europe_old_price' => $request->europe_old_price,
            'duration' => $request->duration,
        ]);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
