<?php

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
    Route::get('/', function () {
        return Inertia\Inertia::render('Home');
    })->name('home');

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

    Route::get('/profile/{username}', function () {
        return Inertia\Inertia::render('Profile');
    })->name('account.show');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
