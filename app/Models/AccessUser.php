<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessUser extends Model
{
    protected $table = 'access_user';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'access',
        'user',
        'added_by',
        'added_date',
    ];

    public function access()
    {
        return $this->belongsTo(Access::class, 'access', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
