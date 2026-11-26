<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\CollectionController;

// route search
Route::get('/media/search', [MediaController::class, 'search']);
Route::apiResource('media', MediaController::class);

// apiResource: otomatis mendaftarkan lima endpoint CRUD
Route::apiResource('media', MediaController::class);
Route::get('/users/{userId}/media', [CollectionController::class, 'index']);
Route::post('/users/{userId}/media/{mediaId}', [CollectionController::class, 'store']);
Route::delete('/users/{userId}/media/{mediaId}', [CollectionController::class, 'destroy']);
