<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAdminFile extends Model
{
    protected $table = 'order_admin_file';

    public $timestamps = false;

    protected $fillable = [
        'oid',
        'file_path',
        'added_by',
        'added_date'
    ];
}