<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
   protected $fillable = [
        'page_name',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'javascript_code',
        'is_active',
    ];
}