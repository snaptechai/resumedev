<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ArticleCategory::with('subcategories')->orderBy('id', 'desc')->paginate(10);

        return view('admin.article-categories.index', [
            'categories' => $categories,
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
            'category' => 'required|string|max:255',
            'subcategories' => 'nullable|array',
            'subcategories.*' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $category = ArticleCategory::create([
                'category' => $request->category,
                'added_by' => Auth::id(),
                'added_date' => now(),
            ]);

            if ($request->has('subcategories')) {
                foreach ($request->subcategories as $subcategoryName) {
                    if (! empty($subcategoryName)) {
                        ArticleSubCategory::create([
                            'sub_category' => $subcategoryName,
                            'category' => $category->id,
                            'added_by' => Auth::id(),
                            'added_date' => now(),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('article-categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to create category: ' . $e->getMessage());
        }
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
            'category' => 'required|string|max:255',
            'existing_subcategories' => 'nullable|array',
            'existing_subcategories.*' => 'nullable|string|max:255',
            'new_subcategories' => 'nullable|array',
            'new_subcategories.*' => 'nullable|string|max:255',
            'deleted_subcategories' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $category = ArticleCategory::findOrFail($id);

            $category->update([
                'category' => $request->category,
                'last_modified_by' => Auth::id(),
                'last_modified_date' => now(),
            ]);

            if ($request->has('existing_subcategories')) {
                foreach ($request->existing_subcategories as $subcategoryId => $subcategoryName) {
                    if (! empty($subcategoryName)) {
                        ArticleSubCategory::where('id', $subcategoryId)->update([
                            'sub_category' => $subcategoryName,
                            'last_modified_by' => Auth::id(),
                            'last_modified_date' => now(),
                        ]);
                    }
                }
            }

            if ($request->has('new_subcategories')) {
                foreach ($request->new_subcategories as $subcategoryName) {
                    if (! empty($subcategoryName)) {
                        ArticleSubCategory::create([
                            'sub_category' => $subcategoryName,
                            'category' => $category->id,
                            'added_by' => Auth::id(),
                            'added_date' => now(),
                        ]);
                    }
                }
            }

            if ($request->filled('deleted_subcategories')) {
                $deletedIds = explode(',', $request->deleted_subcategories);
                ArticleSubCategory::whereIn('id', $deletedIds)->delete();
            }

            DB::commit();

            return redirect()->route('article-categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ArticleCategory::findOrFail($id);

        $category->subcategories()->delete();

        $category->delete();

        return redirect()->route('article-categories.index')->with('success', 'Category deleted successfully.');
    }
}
