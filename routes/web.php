<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\BandController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Songs Routes
    Route::resource('songs', SongController::class)->only(['edit', 'update', 'destroy', 'create', 'store']);

    // Bands Routes
    Route::resource('bands', BandController::class)->only(['update', 'edit', 'destroy', 'create', 'store']);

    // Albums Routes
    Route::resource('albums', AlbumController::class)->only(['destroy', 'update', 'edit', 'create', 'store']);
});

// Allow guests to view index and show for Songs, Bands, and Albums
Route::resource('songs', SongController::class)->only(['index', 'show']);
Route::resource('bands', BandController::class)->only(['index', 'show']);
Route::resource('albums', AlbumController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
