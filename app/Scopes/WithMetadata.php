<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithMetadata implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->with('user', 'retweet_user', 'images')
            ->withIsLiked()
            ->withIsRetweeted()
            ->withCount(['likes', 'retweets']);
    }
}
