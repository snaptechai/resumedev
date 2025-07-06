<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 14);
        $search = $request->input('search');

        $featuredArticle = Article::with(['articleCategory', 'articleSubCategory'])
            ->where('featured', 'yes')
            ->orderBy('added_date', 'desc')
            ->first();

        $articles = Article::with(['articleCategory', 'articleSubCategory'])
            ->when($featuredArticle, function ($query) use ($featuredArticle) {
                return $query->where('id', '!=', $featuredArticle->id);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('article_title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => [
                'articles' => $articles,
                'featured_article' => $featuredArticle
            ],
            'message' => 'Articles retrieved successfully'
        ]);
    }

    public function show(string $slug)
    {
        $title = str_replace('-', ' ', $slug);
        $article = Article::with(['articleCategory', 'articleSubCategory', 'tags'])
            ->where(function ($query) use ($title) {
                $query->where('title', $title)
                    ->orWhere('article_title', $title);
            })
            ->first();

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $article,
            'message' => 'Article retrieved successfully'
        ]);
    }

    public function latest()
    {
        $articles = Article::with(['articleCategory', 'articleSubCategory'])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'articles' => $articles,
            ],
            'message' => 'Articles retrieved successfully'
        ]);
    }

    public function sitemap()
    {
        $articles = Article::select('title', 'added_date', 'last_modified_date')
            ->orderBy('added_date', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $articles,
            'message' => 'Site map articles retrieved successfully'
        ]);
    }

    public function byCategory(string $categorySlug)
    {
        $category = str_replace('-', ' ', $categorySlug);
        $articles = Article::with(['articleCategory', 'articleSubCategory'])
            ->whereHas('articleCategory', function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => [
                'articles' => $articles,
            ],
            'message' => 'Articles by category retrieved successfully'
        ]);
    }

    public function categorySitemap()
    {
        $categories = ArticleCategory::select('category', 'added_date', 'last_modified_date')
            ->orderBy('added_date', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories,
            'message' => 'Site map categories retrieved successfully'
        ]);
    }

    public function categories()
    {
        $categories = ArticleCategory::with('subcategories')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories,
            'message' => 'Categories retrieved successfully'
        ]);
    }

    public function tagSitemap()
    {
        $tags = Tag::select('id', 'tag', 'added_date', 'last_modified_date')
            ->orderBy('added_date', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $tags,
            'message' => 'Tags retrieved successfully'
        ]);
    }

    public function byTag(string $tagSlug)
    {
        $tag = str_replace('-', ' ', $tagSlug);
        $articles = Article::with(['articleCategory', 'articleSubCategory'])
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('tag.tag', $tag);
            })
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => [
                'articles' => $articles,
            ],
            'message' => 'Articles by tag retrieved successfully'
        ]);
    }
}
