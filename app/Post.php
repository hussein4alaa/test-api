<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function type()
    {
        return 'post';
    }

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
