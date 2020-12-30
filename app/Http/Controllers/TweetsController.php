<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class TweetsController extends Controller
{
    function store(Request $request) {
        //ddd($request->images);
        //
        Validator::make($request->all(), [
            'body' => ['required', 'max:280'],
            'images' => ['array', 'max:4'],
            'images.*' => ['image', 'max:6000'],
        ])->validateWithBag('postTweet');

        DB::transaction(function() use ($request) {
            $tweet = Auth::user()->tweets()->create([
                'body' => $request->body,
            ]);
            
            foreach ($request->images as $image) {
                $path = $image->storePublicly('tweet-images');
                $tweet->images()->create([
                    'path' => $path,
                ]);
            }
        });

        return back();
    }
}
