<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleSubCategory extends Model
{
    protected $table = 'article_sub_category';

    protected $fillable = [
        'sub_category',
        'category',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category', 'id');
    }
}
