<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    function show($username, $filter = null){
        $user = User::where('username', $username)->withCount(['followings', 'followers'])->firstOrFail()->append('is_followed');

        return Inertia::render('Profile', [
            'timeline' => $user->ownTimeline()->get(),
            'profile_user' => $user,
        ]);
    }
}
