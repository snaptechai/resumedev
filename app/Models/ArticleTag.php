<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleTag extends Model
{
    protected $table = 'article_tag';

    protected $fillable = [
        'article',
        'tag',
        'added_by',
        'added_date'
    ];

    public $timestamps = false;

    public function tagTable()
    {
        return $this->belongsTo(Tag::class, 'tag', 'id');
    }
}