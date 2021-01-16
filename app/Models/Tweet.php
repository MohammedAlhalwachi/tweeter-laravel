<?php

namespace App\Models;

use App\Scopes\WithMetadata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable
        = [
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
    protected $casts
        = [
            'is_bookmarked' => 'boolean',
            'is_liked'      => 'boolean',
            'is_retweeted'  => 'boolean',
            'retweeted_at'  => 'datetime',
            'order_value'  => 'datetime',
        ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new WithMetadata);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function retweet_user()
    {
        return $this->belongsTo(User::class, 'retweet_user_id', 'id');
    }

    function images()
    {
        return $this->hasMany(TweetImage::class);
    }

    function bookmarks()
    {
        return $this->belongsToMany(User::class, 'user_tweet_bookmarks');
    }

    function likes()
    {
        return $this->belongsToMany(User::class, 'user_tweet_likes');
    }

    function retweets()
    {
        return $this->belongsToMany(User::class, 'user_tweet_retweets');
    }

    function scopeWithIsLiked($query)
    {
        return $query->addSelect(
            [
                'is_liked' => function ($query) {
                    return $query
                        ->from('user_tweet_likes')
                        ->where(
                            'user_tweet_likes.user_id', '=', Auth::user()->id
                        )
                        ->where(
                            'user_tweet_likes.tweet_id', '=',
                            DB::raw('tweets.id')
                        )
                        ->select(DB::raw('COUNT(1)'));
                }
            ]
        );
    }

    function scopeWithIsRetweeted($query)
    {
        return $query->addSelect(
            [
                'is_retweeted' => function ($query) {
                    return $query
                        ->from('user_tweet_retweets')
                        ->where(
                            'user_tweet_retweets.user_id', '=', Auth::user()->id
                        )
                        ->where(
                            'user_tweet_retweets.tweet_id', '=',
                            DB::raw('tweets.id')
                        )
                        ->select(DB::raw('COUNT(1)'));
                }
            ]
        );
    }

    function scopeWithIsBookmarked($query)
    {
        return $query->addSelect(
            [
                'is_bookmarked' => function ($query) {
                    return $query
                        ->from('user_tweet_bookmarks')
                        ->where(
                            'user_tweet_bookmarks.user_id', '=',
                            Auth::user()->id
                        )
                        ->where(
                            'user_tweet_bookmarks.tweet_id', '=',
                            DB::raw('tweets.id')
                        )
                        ->select(DB::raw('COUNT(1)'));
                }
            ]
        );
    }

    function scopeWithEngagementCount($query)
    {
        return $query->addSelect(
            [
                'engagement_count' => function ($query) {
                    return $query
                        ->select(DB::raw('likes_count'));
                }
            ]
        );
    }
}
