<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    function index()
    {
        $user = Auth::user();

        return Inertia::render(
            'Home', [
                'timeline' => $user->homeTimeline()->get(),
            ]
        );
    }
}
