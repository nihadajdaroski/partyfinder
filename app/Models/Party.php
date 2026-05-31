<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Party extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'date_time',
        'category',
        'image',
        'user_id'
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function attendees()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}