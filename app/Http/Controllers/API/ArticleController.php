<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        
        $featuredArticle = Article::with(['articleCategory', 'articleSubCategory'])
            ->where('featured', 'yes')
            ->orderBy('id', 'desc')
            ->first();
        
        $articles = Article::with(['articleCategory', 'articleSubCategory'])
            ->when($featuredArticle, function($query) use ($featuredArticle) {
                return $query->where('id', '!=', $featuredArticle->id);
            })
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
            ->where(function($query) use ($title) {
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
}
