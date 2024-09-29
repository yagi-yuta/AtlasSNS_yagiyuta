<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
