<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';

    public $timestamps = false;

    protected $fillable = [
        'coupon',
        'used_by',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
        'price',
        'end_date',
        'one_time',
        'start_date'
    ];
}