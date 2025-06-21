<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Article::leftJoin('article_category', 'article.category', '=', 'article_category.id')
            ->leftJoin('article_sub_category', 'article.sub_category', '=', 'article_sub_category.id')
            ->select('article.*', 'article_category.category as category_name', 'article_sub_category.sub_category as sub_category_name');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('article.id', 'like', '%'.$search.'%')
                    ->orWhere('article.title', 'like', '%'.$search.'%')
                    ->orWhere('article.article_title', 'like', '%'.$search.'%')
                    ->orWhere('article_category.category', 'like', '%'.$search.'%')
                    ->orWhere('article_sub_category.sub_category', 'like', '%'.$search.'%');
            });
        }

        $articles = $query->orderBy('article.added_date', 'desc')->paginate(10)->appends([
            'search' => $search,
        ]);

        return view('admin.articles.index', [
            'articles' => $articles,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ArticleCategory::all();
        $subcategories = ArticleSubCategory::all();
        $article_tags = Tag::all();
        
        return view('admin.articles.create', compact('categories', 'subcategories','article_tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'article_title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|exists:article_category,id',
            'sub_category' => 'nullable|exists:article_sub_category,id',
            'added_date' => 'nullable|date',
            'featured' => 'nullable|boolean',
            'seo_article_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'img_title' => 'nullable|string|max:255',
            'img_description' => 'nullable|string',
            'img_alt' => 'nullable|string|max:255',
            'schema_code' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:10248',
        ]);

        $articleData = $request->except(['_token', 'image']);

        $articleData['featured'] = $request->has('featured') ? 'yes' : 'no';

        $articleData['added_by'] = Auth::id();
        $articleData['added_date'] = $request->added_date ?? now();

        if ($request->hasFile('image')) {
            $articleData['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($articleData);

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

        $article = Article::findOrFail($id);
        $categories = ArticleCategory::all();
        $subcategories = ArticleSubCategory::all();
        $article_tag = ArticleTag::where('article',$id)->first();

        return view('admin.articles.show', compact('article', 'categories', 'subcategories','article_tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = ArticleCategory::all();
        $subcategories = ArticleSubCategory::all();
        $article_tags = Tag::all();
        $article_tag = ArticleTag::where('article', $id)->first();
        
        if ($article_tag) {
            $article_tag_id = $article_tag->tag;
        } else {      
            $article_tag_id = 0;
        }

        return view('admin.articles.edit', compact('article', 'categories', 'subcategories','article_tags','article_tag_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'article_title' => 'required|string|max:255',
            'description' => 'required',
            'category' => 'required|exists:article_category,id',
            'sub_category' => 'nullable|exists:article_sub_category,id',
            'added_date' => 'nullable|date',
            'featured' => 'nullable|boolean',
            'seo_article_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'img_title' => 'nullable|string|max:255',
            'img_description' => 'nullable|string',
            'img_alt' => 'nullable|string|max:255',
            'schema_code' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:10248',
        ]);

        $article = Article::findOrFail($id);
        $articleData = $request->except(['_token', '_method', 'image']);

        $articleData['featured'] = $request->has('featured')  ? 'yes' : 'no';

        $articleData['last_modified_by'] = Auth::id();
        $articleData['last_modified_date'] = now();

        if ($request->hasFile('image')) {
            $articleData['image'] = $request->file('image')->store('articles', 'public');
        }

        $updated = $article->update($articleData);

        if ($updated && $request->article_tag) {
            $article_tag = ArticleTag::where('article', $id)->first();

            if ($article_tag) {
                $article_tag->tag = $request->article_tag;
                $article_tag->save();
            } else {
                $article_tag = new ArticleTag();
                $article_tag->article = $id;
                $article_tag->tag = $request->article_tag;
                $article_tag->added_by = Auth::id();
                $article_tag->added_date = $request->added_date ?? now();
                $article_tag->save();
            }
        }

        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article->image && file_exists(public_path($article->image))) {
            unlink(public_path($article->image));
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
}