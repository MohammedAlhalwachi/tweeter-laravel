<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExploreController extends Controller
{
    private $searchQuery;
    
    public function __construct(Request $request)
    {
        $this->searchQuery = $request->q;
    }

    function showTop()
    {
        $topTweets = Tweet::orderBy('likes_count', 'desc')->where('body', 'like', '%'.$this->searchQuery.'%')->take(50)->get();

        return Inertia::render(
            'Explore', [
                'timeline' => $topTweets,
                'searchQuery' => $this->searchQuery,
            ]
        );
    }
    
    function showLatest()
    {
        $latestTweets = Tweet::orderBy('created_at', 'desc')->where('body', 'like', '%'.$this->searchQuery.'%')->take(50)->get();

        return Inertia::render(
            'Explore', [
                'timeline' => $latestTweets,
                'searchQuery' => $this->searchQuery,
            ]
        );
    }

    function showPeople()
    {
        $topPeople = User::withCount('followers')->orderBy('followers_count', 'desc')->where('name', 'like', '%'.$this->searchQuery.'%')->take(50)->get();

        return Inertia::render(
            'Explore', [
                'timeline' => $topPeople,
                'searchQuery' => $this->searchQuery,
            ]
        );
    }

    function showMedia()
    {
        $topTweets = Tweet::has('images')->orderBy('likes_count', 'desc')->where('body', 'like', '%'.$this->searchQuery.'%')->take(50)->get();

        return Inertia::render(
            'Explore', [
                'timeline' => $topTweets,
                'searchQuery' => $this->searchQuery,
            ]
        );
    }

}
