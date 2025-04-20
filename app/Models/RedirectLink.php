<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectLink extends Model
{
    protected $table = 'redirect_link';

    public $timestamps = false;

    protected $fillable = [
        'original_url',
        'new_url',
        'note',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];
}