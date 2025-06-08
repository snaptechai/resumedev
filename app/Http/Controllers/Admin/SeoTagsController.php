<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SeoTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metatags = MetaTag::orderBy('id', 'desc')->paginate(10);

        return view('admin.seo-tags.index', [
            'metatags' => $metatags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.seo-tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $urlRules = ['nullable', 'string'];
        
        if ($request->url === null) {
            $nullUrlExists = MetaTag::whereNull('url')->exists();
            if ($nullUrlExists) {
                $urlRules[] = 'required'; 
            }
        } else {
            $urlRules[] = Rule::unique('meta_tags', 'url');
        }

        $validated = $request->validate([
            'page_name' => 'required|string|unique:meta_tags,page_name',
            'url' => $urlRules,
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'meta_keywords' => 'nullable|string',
            'javascript_code' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MetaTag::create($validated);

        return redirect()->route('seo-tags.index')->with('success', 'Meta tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seoTag = MetaTag::findOrFail($id);
        return view('admin.seo-tags.show', [
            'seoTag' => $seoTag,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $seoTag = MetaTag::findOrFail($id);
        return view('admin.seo-tags.edit', [
            'seoTag' => $seoTag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $seoTag = MetaTag::findOrFail($id);
        
        $urlRules = ['nullable', 'string'];
        
        if ($request->url === null && $seoTag->url !== null) {
            $nullUrlExists = MetaTag::whereNull('url')->exists();
            if ($nullUrlExists) {
                $urlRules[] = 'required';
            }
        } elseif ($request->url !== null) {
            $urlRules[] = Rule::unique('meta_tags', 'url')->ignore($id);
        }
        
        $request->validate([
            'page_name' => 'required|string|max:255|' . Rule::unique('meta_tags')->ignore($id),
            'url' => $urlRules,
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'nullable|string',
            'javascript_code' => 'nullable|string',
        ]);
        
        $seoTag->update([
            'page_name' => $request->page_name,
            'url' => $request->url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'javascript_code' => $request->javascript_code,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('seo-tags.index')->with('success', 'Meta tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seoTag = MetaTag::findOrFail($id);
        $seoTag->delete();
        return redirect()->route('seo-tags.index')->with('success', 'Meta tag was deleted.');
    }
}