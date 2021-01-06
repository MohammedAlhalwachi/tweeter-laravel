<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Traits\HasProfileBanner;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasProfileBanner;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_followed' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'profile_banner_url',
    ];

    protected function profilePhotoDisk() {
        return config('filesystems.default');
    }
    
    function tweets() {
        return $this->hasMany(Tweet::class);
    }

    function followings() {
        return $this->belongsToMany(User::class, 'follower_followee', 'follower_id', 'followee_id');
    }
    
    function follow(User $user){
        $this->followings()->syncWithoutDetaching([$user->id]);
    }
    function unfollow(User $user){
        $this->followings()->detach($user->id);
    }
    
    function getIsFollowedAttribute(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

    function followers() {
        return $this->belongsToMany(User::class, 'follower_followee', 'followee_id', 'follower_id');
    }

    function likes() {
        return $this->belongsToMany(Tweet::class, 'user_tweet_likes');
    }

    function like(Tweet $tweet) {
        $this->likes()->syncWithoutDetaching([$tweet->id]);
    }
    function unlike(Tweet $tweet) {
        $this->likes()->detach($tweet->id);
    }
    
    function ownTimeline() {
        return $this->tweets()->with('user', 'images')->withCount(['likes'])->orderBy('created_at', 'desc');
    }
    
    function homeTimeline() {
        //TODO:: add own timeline with the results. Use raw SQL.
        return $this->hasManyDeepFromRelations($this->followings(), (new User)->tweets())->with('user', 'images')->withCount(['likes'])->orderBy('created_at', 'desc');
    }
}
