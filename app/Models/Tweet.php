<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_liked' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_liked'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }
    
    function images() {
        return $this->hasMany(TweetImage::class);
    }

    function likes() {
        return $this->belongsToMany(User::class, 'user_tweet_likes');
    }

    function getIsLikedAttribute(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
