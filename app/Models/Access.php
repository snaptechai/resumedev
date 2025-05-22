<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'access',
    ];

    public function accessUsers()
    {
        return $this->hasMany(AccessUser::class, 'access', 'id');
    }
}
