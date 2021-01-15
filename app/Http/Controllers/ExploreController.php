<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExploreController extends Controller
{
    function showTop()
    {
        $topTweets = Tweet::orderBy('likes_count', 'desc')->withEngagementCount()->take(10)->get();

        return Inertia::render(
            'Explore', [
                'timeline' => $topTweets,
            ]
        );
    }
}
