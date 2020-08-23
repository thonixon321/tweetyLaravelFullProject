<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value) //this is a custom accessor which allows this to be referenced like auth()->user()->avatar
    {
        //use the users chosen avatar ($value), but if it doesn't exist, use default
        return asset($value ?: '/images/default-image.png'); //asset creates a full url to the asset
    }
    //custom mutator, so when I do $user->password = something, it passes through here first
    // public function setPasswordAttribute($value) 
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function timeline()
    {
        //return tweets from current user and everyone they follow
        $ids = $this->follows()->pluck('id'); //these are the ids of who this user follows
        $ids->push($this->id); //put this users id in that array as well

        return Tweet::whereIn('user_id', $ids)->withLikes()->latest()->get();
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

   

    //when route model binding (like when showing a profile with /profiles/1) you can override the primary key binding here with another column in the users table - like name instead of id num
    //--this has been updated for laravel 7 where you can just do this in the web.php routes file with a colon in the wildcard - /profiles/{user:name}
    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
    //path to users profile
    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }
}
