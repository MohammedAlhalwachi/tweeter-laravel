<?php

namespace App\Models;

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
    protected $appends = ['profile_photo_url', 'profile_banner_url'];

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

    function getIsFollowedAttribute(): bool
    {
        return $this->followers()->where('follower_id', Auth::user()->id)
            ->exists();
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

    function ownTimeline()
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
                Auth::user()->id
            )
            ->select(
                [
                    DB::raw(
                        'CONCAT(`user_tweet_retweets`.`user_id`, `user_tweet_retweets`.`tweet_id`, `user_tweet_retweets`.`tweet_id`) as unique_id'
                    ),
                    'tweets.id',
                    'tweets.body',
                    'tweets.user_id',
                    'tweets.created_at',
                    'tweets.updated_at',
                    'user_tweet_retweets.created_at as retweeted_at',
                    DB::raw(
                        'CAST(user_tweet_retweets.user_id AS INT) as retweet_user_id'
                    )
                ]
            )
            ->with('user', 'retweet_user', 'images')
            ->withIsLiked()
            ->withIsRetweeted()
            ->withCount(['likes', 'retweets']);

        return $this->tweets()
            ->select(
                'tweets.id as unique_id',
                'tweets.id',
                'tweets.body',
                'tweets.user_id',
                'tweets.created_at',
                'tweets.updated_at',
                DB::raw('NULL as retweeted_at'),
                DB::raw('NULL as retweet_user_id')
            )
            ->union($myRetweets)
            ->with('user', 'retweet_user', 'images')
            //VERY IMPORTANT to have the smae order of "with-*" of the other query $myRetweets
            //TODO:: refactor the retweet query to a single method
            ->withIsLiked()
            ->withIsRetweeted()
            ->withCount(['likes', 'retweets'])
            ->orderBy(
                DB::raw('COALESCE(retweeted_at, created_at)'), 'desc'
            );
    }

    function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    function homeTimeline()
    {
        $user = Auth::user();

        //Retweets
        $retweets = Tweet::join(
            'user_tweet_retweets',
            'tweets.id',
            '=',
            'user_tweet_retweets.tweet_id'
        )
            //My retweets
            ->where(
                'user_tweet_retweets.user_id',
                '=',
                $user->id
            //Followings retweets
            )->orWhereIn(
                'user_tweet_retweets.user_id', function ($query) use ($user) {
                $query->selectRaw('followee_id')
                    ->from('follower_followee')
                    ->where(
                        'follower_followee.follower_id',
                        '=',
                        $user->id
                    );
            }
            )
            ->select(
                [
                    DB::raw(
                        'CONCAT(`user_tweet_retweets`.`user_id`, `user_tweet_retweets`.`tweet_id`, `user_tweet_retweets`.`tweet_id`) as unique_id'
                    ),
                    'tweets.id',
                    'tweets.body',
                    'tweets.user_id',
                    'tweets.created_at',
                    'tweets.updated_at',
                    'user_tweet_retweets.created_at as retweeted_at',
                    DB::raw(
                        'CAST(user_tweet_retweets.user_id AS INT) as retweet_user_id'
                    )
                ]
            )
            ->with('user', 'retweet_user', 'images')
            ->withIsLiked()
            ->withIsRetweeted()
            ->withCount(['likes', 'retweets']);

        return
            Tweet::where('user_id', '=', $user->id)
                //My followings tweets
                ->orWhereIn(
                    'user_id',
                    function ($query) use ($user) {
                        $query->selectRaw('followee_id')
                            ->from('follower_followee')
                            ->where(
                                'follower_followee.follower_id',
                                '=',
                                $user->id
                            );
                    }
                )
                ->select(
                    'tweets.id as unique_id',
                    'tweets.id',
                    'tweets.body',
                    'tweets.user_id',
                    'tweets.created_at',
                    'tweets.updated_at',
                    DB::raw('NULL as retweeted_at'),
                    DB::raw('NULL as retweet_user_id')
                )
                //My retweets
                ->union($retweets)
                ->with('user', 'retweet_user', 'images')
                ->withIsLiked()
                ->withIsRetweeted()
                ->withCount(['likes', 'retweets'])
                ->orderBy(
                    DB::raw('COALESCE(retweeted_at, created_at)'), 'desc'
                );
    }

    protected function profilePhotoDisk()
    {
        return config('filesystems.default');
    }
}
