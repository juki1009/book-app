<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'author',
        'description',
        'review',
        'rating',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}