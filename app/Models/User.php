<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory,  Notifiable;

    protected $table = 'user';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'registered_date',
        'type',
        'password',
        'added_by',
        'added_date',
        'last_modified_by',
        'last_modified_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'registered_date' => 'datetime',
            'added_date' => 'datetime',
            'last_modified_date' => 'datetime',
        ];
    }

    public function accessUsers()
    {
        return $this->hasMany(AccessUser::class, 'user', 'id');
    }

    public function permissions()
    {
        return $this->hasManyThrough(
            Access::class,
            AccessUser::class,
            'user',
            'id',
            'id',
            'access'
        );
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->where('access.access', $permission)->exists();
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'writer', 'id');
    }

    public function getMessageNotifications()
    {
        if ($this->id == 1) {
            return Message::select('message.*')
                ->where('status', '0')
                ->where('type', 'user')
                ->whereIn('id', function ($query) {
                    $query->selectRaw('MAX(id)')
                        ->from('message')
                        ->where('status', '0')
                        ->where('type', 'user')
                        ->groupBy('oid');
                })
                ->get();
        }

        $orderIds = Order::where('writer', $this->id)->pluck('id');

        if ($orderIds->isNotEmpty()) {
            return Message::select('message.*')
                ->where('status', '0')
                ->where('type', 'user')
                ->whereIn('oid', $orderIds)
                ->whereIn('id', function ($query) use ($orderIds) {
                    $query->selectRaw('MAX(id)')
                        ->from('message')
                        ->where('status', '0')
                        ->where('type', 'user')
                        ->whereIn('oid', $orderIds)
                        ->groupBy('oid');
                })
                ->get();
        }

        return collect();
    }
}
