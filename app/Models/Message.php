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
        'original_filename',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'oid', 'id');
    }

    public function attachments()
{
    return $this->hasMany(OrderAttachment::class, 'message_id', 'id');
}
}