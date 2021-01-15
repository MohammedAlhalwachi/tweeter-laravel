<?php

use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileFollowingController;
use App\Http\Controllers\TweetBookmarkController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetLikeController;
use App\Http\Controllers\TweetRetweetController;

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Explore 
//    Route::prefix('explore')->group(function () {
//        Route::get('/', function () {
//            return Inertia\Inertia::render('Explore');
//        })->name('explore.top');
//
//        Route::get('/latest', function () {
//            return Inertia\Inertia::render('Explore');
//        })->name('explore.latest');
//
//        Route::get('/people', function () {
//            return Inertia\Inertia::render('Explore');
//        })->name('explore.people');
//
//        Route::get('/media', function () {
//            return Inertia\Inertia::render('Explore');
//        })->name('explore.media');
//    });

    // Explore 
    Route::get('/explore/', [ExploreController::class, 'showTop'])
        ->name('explore.top.show');

    // Bookmarks 
    Route::get('/bookmarks/{filter?}', [BookmarksController::class, 'show'])
        ->name('bookmarks.show')
        ->where(['filter' => '(media)']);

    // User Profile 
    Route::get('/profiles/{username}/{filter?}', [ProfileController::class, 'show'])
        ->name('profile.show')
        ->where(['filter' => '(media|likes)']);

    Route::post('/profiles/{id}/followings', [ProfileFollowingController::class, 'store'])
        ->name('profile.followings.store');
    Route::delete('/profiles/{id}/followings', [ProfileFollowingController::class, 'destroy'])
        ->name('profile.followings.destroy');

    // Tweet 
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    
    Route::post('/tweets/{id}/likes', [TweetLikeController::class, 'store'])->name('tweets.likes.store');
    Route::delete('/tweets/{id}/likes', [TweetLikeController::class, 'destroy'])->name('tweets.likes.destroy');
    
    Route::post('/tweets/{id}/retweets', [TweetRetweetController::class, 'store'])->name('tweets.retweets.store');
    Route::delete('/tweets/{id}/retweets', [TweetRetweetController::class, 'destroy'])->name('tweets.retweets.destroy');
    
    Route::post('/tweets/{id}/bookmarks', [TweetBookmarkController::class, 'store'])->name('tweets.bookmarks.store');
    Route::delete('/tweets/{id}/bookmarks', [TweetBookmarkController::class, 'destroy'])->name('tweets.bookmarks.destroy');
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia\Inertia::render('Dashboard');
//})->name('dashboard');
