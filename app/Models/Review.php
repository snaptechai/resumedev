<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    public $timestamps = false;

    protected $fillable = [
        'uid',
        'review',
        'added_date',
        'status',
        'last_modified_by',
        'last_modified_date',
        'name',
        'username',
        'star',
        'service_start',
        'recommend_star',
        'oid',
    ]; 
}