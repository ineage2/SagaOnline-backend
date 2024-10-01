<?php

// routes/api.php Laravel routes/api.php
use App\Http\Controllers\Api\v1\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// News
Route::prefix('news')->group(function () {
    // get News per_page and page
    Route::get('', [NewsController::class, 'index']);
    // get Current News by id
    Route::get('{id}', [NewsController::class, 'show']);
    // Create News
    Route::post('', [NewsController::class, 'store']);
    // Update News
    Route::put('{id}', [NewsController::class, 'update']); // full change
    Route::patch('{id}', [NewsController::class, 'update']); // partial change
    // Delete News
    Route::delete('{id}', [NewsController::class, 'destroy']);
    // Search News by tag
    Route::get('tag/{tag}', [NewsController::class, 'searchByTag']);
});
