<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
    
    public function couponTable()
    {
        return $this->belongsTo(Coupon::class, 'coupon', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    public function message()
    {
        return $this->hasMany(Message::class, 'oid', 'id');
    }

    public function addons()
    {
        return $this->hasMany(Addon::class, 'id', 'package_id');
    }

    public function needsAdminReply(): bool
    {
        $latestMessage = $this->message()
            ->orderByDesc('adate')
            ->first();

        if (! $latestMessage) {
            return false;
        }

        if ($latestMessage->fid === $this->uid) {
            $adminReplied = $this->message()
                ->where(function ($query) {
                    $query->where('type', 'admin')
                        ->orWhere('fid', '!=', $this->uid);
                })
                ->where('adate', '>', $latestMessage->adate)
                ->exists();

            $hoursPassed = Carbon::parse($latestMessage->adate)->diffInHours(now());

            return ! $adminReplied && $hoursPassed > 1;
        }

        return false;
    }
}