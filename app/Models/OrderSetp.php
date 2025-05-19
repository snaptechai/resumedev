<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSetp extends Model
{
    protected $table = 'order_setps';

    protected $fillable = [
        'step',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_status');
    }
}
