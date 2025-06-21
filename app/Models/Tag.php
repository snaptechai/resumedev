<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $fillable = [
        'tag',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    public $timestamps = false;

    public function articleTag()
    {
        return $this->hasMany(ArticleTag::class,'id','tag');
    }
}