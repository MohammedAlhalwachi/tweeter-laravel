<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileFollowingController;
use App\Http\Controllers\TweetController;
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
    Route::prefix('explore')->group(function () {
        Route::get('/', function () {
            return Inertia\Inertia::render('Explore');
        })->name('explore.top');

        Route::get('/latest', function () {
            return Inertia\Inertia::render('Explore');
        })->name('explore.latest');

        Route::get('/people', function () {
            return Inertia\Inertia::render('Explore');
        })->name('explore.people');

        Route::get('/media', function () {
            return Inertia\Inertia::render('Explore');
        })->name('explore.media');
    });

    // Bookmarks 
    Route::prefix('bookmarks')->group(function () {
        Route::get('/', function () {
            return Inertia\Inertia::render('Bookmarks');
        })->name('bookmarks.tweets');

        Route::get('/media', function () {
            return Inertia\Inertia::render('Bookmarks');
        })->name('bookmarks.media');

        Route::get('/likes', function () {
            return Inertia\Inertia::render('Bookmarks');
        })->name('bookmarks.likes');
    });

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
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
