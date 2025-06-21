<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_category';

    protected $fillable = [
        'category',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    public $timestamps = false;

    public function subcategories()
    {
        return $this->hasMany(ArticleSubCategory::class, 'category', 'id');
    }

    public function articleTable()
    {
        return $this->hasMany(Article::class, 'id', 'category');
    }
}