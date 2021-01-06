<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetLikeController extends Controller
{
    function store(Request $request)
    {
        $tweet = Tweet::findOrFail($request->id);
        Auth::user()->like($tweet);
        return back();
    }

    function destroy(Request $request)
    {
        $tweet = Tweet::findOrFail($request->id);
        Auth::user()->unlike($tweet);
        return back();
    }
}
