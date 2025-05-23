<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    public $timestamps = false;

    protected $fillable = [
        'oid',
        'fid',
        'tid',
        'message',
        'status',
        'type',
        'adate',
        'attachment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'oid', 'id');
    }
}
