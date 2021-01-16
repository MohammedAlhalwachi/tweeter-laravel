<?php

namespace App\Models;

use App\Scopes\WithIsFollowed;
use App\Scopes\WithMetadata;
use App\Traits\HasProfileBanner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasProfileBanner;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
            'two_factor_recovery_codes',
            'two_factor_secret'
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
            'is_followed'       => 'boolean'
        ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends
        = ['profile_photo_url', 'profile_banner_url'];

    function follow(User $user)
    {
        $this->followings()->syncWithoutDetaching([$user->id]);
    }

    function followings()
    {
        return $this->belongsToMany(
            User::class,
            'follower_followee',
            'follower_id',
            'followee_id'
        );
    }

    function unfollow(User $user)
    {
        $this->followings()->detach($user->id);
    }

    function scopeWithIsFollowed($query)
    {
        return $query->addSelect(
            [
                'is_followed' => function ($query) {
                    return $query
                        ->from('follower_followee')
                        ->where(
                            'follower_followee.follower_id', '=',
                            Auth::user()->id
                        )
                        ->where(
                            'follower_followee.followee_id', '=',
                            DB::raw('users.id')
                        )
                        ->select(DB::raw('COUNT(1)'));
                }
            ]
        );
        //        return $this->followers()->where('follower_id', Auth::user()->id)
        //            ->exists();
    }

    function followers()
    {
        return $this->belongsToMany(
            User::class, 'follower_followee', 'followee_id', 'follower_id'
        );
    }

    function like(Tweet $tweet)
    {
        $this->likes()->syncWithoutDetaching([$tweet->id]);
    }

    function likes()
    {
        return $this->belongsToMany(Tweet::class, 'user_tweet_likes')
            ->withTimestamps();
    }

    function unlike(Tweet $tweet)
    {
        $this->likes()->detach($tweet->id);
    }

    function retweet(Tweet $tweet)
    {
        $this->retweets()->syncWithoutDetaching([$tweet->id]);
    }

    function retweets()
    {
        return $this->belongsToMany(Tweet::class, 'user_tweet_retweets')
            ->withTimestamps();
    }

    function unretweet(Tweet $tweet)
    {
        $this->retweets()->detach($tweet->id);
    }

    function bookmark(Tweet $tweet)
    {
        $this->bookmarks()->syncWithoutDetaching([$tweet->id]);
    }

    function bookmarks()
    {
        return $this->belongsToMany(Tweet::class, 'user_tweet_bookmarks')
            ->withTimestamps();
    }

    function unbookmark(Tweet $tweet)
    {
        $this->bookmarks()->detach($tweet->id);
    }

    function ownTimeline()
    {
        $myRetweets = $this->getMyRetweetsQuery();

        return $this->getMyTweetsQuery()
            ->union($myRetweets)
            ->orderBy(
                DB::raw('order_value'), 'desc'
            );
    }

    /**
     * @return mixed
     */
    public function getMyRetweetsQuery()
    {
        $myRetweets = Tweet::join(
            'user_tweet_retweets',
            'tweets.id',
            '=',
            'user_tweet_retweets.tweet_id'
        )
            //My retweets
            ->where(
                'user_tweet_retweets.user_id',
                '=',
                $this->id
            )
            ->select(
                [
                    DB::raw(
                        'CAST(CONCAT("user_tweet_retweets"."user_id", "user_tweet_retweets"."tweet_id", "user_tweet_retweets"."tweet_id") as bigint) as unique_id'
                    ),
                    'tweets.id',
                    'tweets.body',
                    'tweets.user_id',
                    'tweets.created_at',
                    'tweets.updated_at',
                    'user_tweet_retweets.created_at as retweeted_at',
                    DB::raw(
                        'CAST(user_tweet_retweets.user_id AS INT) as retweet_user_id'
                    ),
                    DB::raw('COALESCE(user_tweet_retweets.created_at, tweets.created_at) as order_value')
                ]
            );
        return $myRetweets;
    }

    /**
     * @return mixed
     */
    public function getMyTweetsQuery()
    {
        return $this->tweets()
            ->select(
                'tweets.id as unique_id',
                'tweets.id',
                'tweets.body',
                'tweets.user_id',
                'tweets.created_at',
                'tweets.updated_at',
                DB::raw('NULL as retweeted_at'),
                DB::raw('NULL as retweet_user_id'),
                DB::raw('COALESCE(tweets.created_at) as order_value')
            );
    }

    function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    function ownTimelineOnlyWithMedia()
    {
        $myRetweets = $this->getMyRetweetsQuery()
            ->has('images');

        return $this->getMyTweetsQuery()
            ->has('images')
            ->union($myRetweets)
            ->orderBy(
                DB::raw('order_value'), 'desc'
            );
    }

    function homeTimeline()
    {
        //Retweets
        $retweets = $this->getMyAndFollowingsRetweetsQuery();

        return
            $this->getMyAndFollowingsTweetsQuery()
                //Retweets
                ->union($retweets)
                ->orderBy(
                    DB::raw('order_value'), 'desc'
                )->take(50);
    }

    /**
     * @return mixed
     */
    public function getMyAndFollowingsRetweetsQuery()
    {
        $retweets = $this->getMyRetweetsQuery()
            //My followings retweets
            ->orWhereIn(
                'user_tweet_retweets.user_id', function ($query) {
                $query->selectRaw('followee_id')
                    ->from('follower_followee')
                    ->where(
                        'follower_followee.follower_id',
                        '=',
                        $this->id
                    );
            }
            );


        return $retweets;
    }

    /**
     * @return mixed
     */
    public function getMyAndFollowingsTweetsQuery()
    {
        return Tweet::where('user_id', '=', $this->id)
            //My followings tweets
            ->orWhereIn(
                'user_id',
                function ($query) {
                    $query->selectRaw('followee_id')
                        ->from('follower_followee')
                        ->where(
                            'follower_followee.follower_id',
                            '=',
                            $this->id
                        );
                }
            )->select(
                'tweets.id as unique_id',
                'tweets.id',
                'tweets.body',
                'tweets.user_id',
                'tweets.created_at',
                'tweets.updated_at',
                DB::raw('NULL as retweeted_at'),
                DB::raw('NULL as retweet_user_id'),
                DB::raw('tweets.created_at as order_value')
            );
    }

    protected function profilePhotoDisk()
    {
        return config('filesystems.default');
    }
}
