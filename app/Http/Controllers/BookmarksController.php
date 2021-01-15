<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookmarksController extends Controller
{
    function show($filter = null)
    {
        $user = Auth::user();

        $bookmarksQuery = $user->bookmarks()->orderBy('created_at', 'desc');
        return Inertia::render(
            'Bookmarks', [
                'timeline' => $filter === 'media' ? $bookmarksQuery->has('images')->get() : $bookmarksQuery->get(),
            ]
        );
    }
}
