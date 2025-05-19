<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    public $timestamps = false;

    protected $gurded = [
        'id',
    ];

    protected $fillable = [
        'uid',
        'package_id',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
        'payment_status',
        'order_status',
        'total_price',
        'end_date',
        'express',
        'order_type',
        'paid',
        'template',
        'affiliate_user',
        'ref',
        'signed_date_time',
        'signature',
        'message',
        'domain',
        'currency',
        'currency_symbol',
        'writer',
        'admin_note',
        'coupon',
    ];

    public function orderStatus()
    {
        return $this->hasOne(OrderSetp::class, 'id', 'order_status');
    }

    public function assignedWriter()
    {
        return $this->belongsTo(User::class, 'writer', 'id');
    }
}
