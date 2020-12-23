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

    Route::get('/explore', function () {
        return Inertia\Inertia::render('Explore');
    })->name('explore');

    Route::get('/bookmarks', function () {
        return Inertia\Inertia::render('Bookmarks');
    })->name('bookmarks');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
