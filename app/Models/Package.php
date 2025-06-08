<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'price',
        'short_description',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
        'full_description',
        'duration',
        'image',
        'europe_price',
        'old_price',
        'europe_old_price',
        'is_popular',
    ];

    public function template()
    {
        return $this->hasMany(Template::class, 'package');
    }

    public function addon()
    {
        return $this->hasMany(Addon::class, 'id', 'package_id');
    }
}
