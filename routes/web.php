<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeployController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilePondController;
use App\Http\Controllers\AnalyticsController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/deploy', [DeployController::class, 'deploy']);

Route::get('/', [PropertyController::class, 'index']);
Route::get('/properties/create', [PropertyController::class, 'create']);
Route::post('/properties', [PropertyController::class, 'store']);
Route::get('/properties/search', [PropertyController::class, 'search']);
Route::get('/properties/{property}', [PropertyController::class, 'show']);
Route::post('/properties/{property}/reports', [PropertyController::class, 'createReport']);
Route::post('/properties/{property}/reviews', [PropertyController::class, 'createReview']);
Route::post('/properties/{property}/favourites', [UserController::class, 'createFavouritedProperty']);
Route::post('/users/{user}/request-call-back', [UserController::class, 'requestCallBack']);

Route::post('/analytics', [AnalyticsController::class, 'store']);

Route::post('/filepond/process', [FilePondController::class, 'process']);
Route::delete('/filepond/revert', [FilePondController::class, 'revert']);

Route::post('keep-csrf-token-alive', function() {
    return 'Token must have been valid, and the session expiration has been extended.';//https://stackoverflow.com/q/31449434/470749
});

require __DIR__.'/auth.php';
