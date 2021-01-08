<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetRetweetController extends Controller
{
    function store(Request $request)
    {
        $tweet = Tweet::findOrFail($request->id);
        Auth::user()->retweet($tweet);
        return back();
    }

    function destroy(Request $request)
    {
        $tweet = Tweet::findOrFail($request->id);
        Auth::user()->unretweet($tweet);
        return back();
    }
}
