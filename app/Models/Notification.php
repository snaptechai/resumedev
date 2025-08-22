<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';

    public $timestamps = false;

    protected $fillable = [
       'notification',
       'url',
       'to_id',
       'from_id',
       'added_date',
       'status',
       'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function readers()
    {
        return $this->hasMany(NotificationReader::class);
    }
}