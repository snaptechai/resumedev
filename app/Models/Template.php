<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template';

    public $timestamps = false;

    protected $fillable = [
        'package',
        'image',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date'
    ];

    public function packagename()
    {
        return $this->belongsTo(Package::class,'package','id');
    }
}