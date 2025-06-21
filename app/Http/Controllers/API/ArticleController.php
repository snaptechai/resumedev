<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 14);

        $featuredArticle = Article::with(['articleCategory', 'articleSubCategory'])
            ->where('featured', 'yes')
            ->orderBy('added_date', 'desc')
            ->first();

        $articles = Article::with(['articleCategory', 'articleSubCategory'])
            ->when($featuredArticle, function ($query) use ($featuredArticle) {
                return $query->where('id', '!=', $featuredArticle->id);
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
        $article = Article::with(['articleCategory', 'articleSubCategory'])
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
}
