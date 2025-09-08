<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (optioneel, kan je weghalen)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Songs CRUD (public)
Route::resource('songs', SongController::class);

// Bands CRUD (public)
Route::resource('bands', BandController::class);

// Albums CRUD (public)
Route::resource('albums', AlbumController::class);

// Test DB connection
Route::get('/testdb', function () {
    try {
        DB::connection()->getPdo();

        return 'DB connected!';
    } catch (\Exception $e) {
        return 'DB connection failed: '.$e->getMessage();
    }
});
