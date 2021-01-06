<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileFollowingController extends Controller
{
    function store(Request $request){
        $toFollowUser = User::find($request->id);

        Auth::user()->follow($toFollowUser);

        return back();
    }
    
    function destroy(Request $request){
        $toUnfollowUser = User::find($request->id);

        Auth::user()->unfollow($toUnfollowUser);

        return back();
    }
}
