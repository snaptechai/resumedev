<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    public $timestamps = false;

    protected $fillable = [
        'description',
        'background_color',
        'font_color',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
        'timmer_status',
        'banner_status',
        'number_of_dates',
        'end_date'
    ];
}