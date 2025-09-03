<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\BandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All routes are public. No authentication required.
|
*/

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Profile routes — still works but public
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Songs CRUD (all routes public)
Route::resource('songs', SongController::class);

// Bands CRUD (all routes public)
Route::resource('bands', BandController::class);

// Albums CRUD (all routes public)
Route::resource('albums', AlbumController::class);

// Optional: remove auth.php entirely
// require __DIR__.'/auth.php';
