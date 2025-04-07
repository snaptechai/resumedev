<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    protected $table = 'page_details';

    protected $fillable = [
        'type',
        'content',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    public $timestamps = false;
}
