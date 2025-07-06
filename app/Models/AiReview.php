<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiReview extends Model
{
    protected $table = 'ai_reviews';

    protected $fillable = [
        'email',
        'file_path',
        'description',
        'is_sent'
    ];

    public $timestamps = false;
}