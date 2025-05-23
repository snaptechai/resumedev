<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $table = 'addons';

    protected $fillable = [
        'price',
        'description',
        'title',
        'package_id',
        'updated_at',
        'created_at'
    ];

    public $timestamps = false;

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}