<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    protected $fillable = [
        'title',
        'description',
        'image',
        'featured',
        'article_title',
        'seo_article_title',
        'seo_description',
        'seo_keywords',
        'og_title',
        'og_description',
        'img_title',
        'img_description',
        'img_alt',
        'schema_code',
        'category',
        'sub_category',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    public $timestamps = false;
}
