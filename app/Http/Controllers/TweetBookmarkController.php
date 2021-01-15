<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetBookmarkController extends Controller
{
    function store(Request $request)
    {
        $tweet = Tweet::findOrFail($request->id);
        Auth::user()->bookmark($tweet);
        return back();
    }

    function destroy(Request $request)
    {
        $tweet = Tweet::findOrFail($request->id);
        Auth::user()->unbookmark($tweet);
        return back();
    }
}
