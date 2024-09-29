<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    //フォロー
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    public function getFollowCountAttribute()
    {
        return $this->following()->count();
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
