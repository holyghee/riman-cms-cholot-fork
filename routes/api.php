<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContentApiController;
use App\Http\Controllers\Api\MediaApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Content Management API
Route::prefix('content')->group(function () {
    Route::get('/pages', [ContentApiController::class, 'index']);
    Route::get('/pages/{slug}', [ContentApiController::class, 'show']);
    Route::post('/pages', [ContentApiController::class, 'store']);
    Route::put('/pages/{slug}', [ContentApiController::class, 'update']);
    Route::patch('/pages/{slug}/blocks', [ContentApiController::class, 'updateBlocks']);
    Route::post('/pages/{slug}/blocks', [ContentApiController::class, 'addBlock']);
    Route::delete('/pages/{slug}', [ContentApiController::class, 'destroy']);
    Route::get('/block-types', [ContentApiController::class, 'blockTypes']);
});

// Media Management API
Route::prefix('media')->group(function () {
    Route::get('/', [MediaApiController::class, 'index']);
    Route::get('/{id}', [MediaApiController::class, 'show']);
    Route::post('/upload', [MediaApiController::class, 'upload']);
    Route::post('/upload-multiple', [MediaApiController::class, 'uploadMultiple']);
    Route::post('/upload-from-url', [MediaApiController::class, 'uploadFromUrl']);
    Route::delete('/{id}', [MediaApiController::class, 'destroy']);
    Route::post('/bulk-delete', [MediaApiController::class, 'bulkDelete']);
    Route::post('/migrate', [MediaApiController::class, 'migrateExistingImages']);
});
