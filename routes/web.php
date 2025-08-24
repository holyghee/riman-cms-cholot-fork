<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Cholot Design Demo Route
Route::get('/cholot', function () {
    return view('cholot-home');
})->name('cholot.home');

// Storage routes for serving images - must be before other routes
Route::get('/storage/{path}', [StorageController::class, 'serveStorage'])->where('path', '.*');

Route::get('/{slug}', [HomeController::class, 'show'])->name('page.show');
