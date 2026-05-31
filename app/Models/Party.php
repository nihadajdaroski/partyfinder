<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'date_time',
        'user_id',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];
}