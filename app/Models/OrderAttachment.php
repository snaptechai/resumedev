<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAttachment extends Model
{
    protected $fillable = [
        'order_id', 
        'message_id', 
        'file_name', 
        'file_path'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }
}