<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    protected $table = 'order_package';

    public $timestamps = false;

    protected $gurded = [
        'id'
    ];
}
