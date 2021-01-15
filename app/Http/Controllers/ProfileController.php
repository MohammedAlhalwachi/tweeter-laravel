<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    function show($username, $filter = null)
    {
        $user = User::where('username', $username)->withCount(
            ['followings', 'followers']
        )->withIsFollowed()->firstOrFail();

        return Inertia::render(
            'Profile', [
                'timeline'     => $this->getTimeLine($user, $filter),
                'profile_user' => $user,
            ]
        );
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    private function getTimeLine($user, $filter)
    {
        if ($filter === null) {
            return $user->ownTimeline()->get();
        } elseif ($filter === 'media') {
            return $user->ownTimelineOnlyWithMedia()->get();
        } elseif ($filter === 'likes') {
            return $user->likes()->get();
        }
    }
}
