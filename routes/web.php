<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DeployController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilePondController;
use App\Http\Controllers\AnalyticsController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::post('/deploy', [DeployController::class, 'deploy']);

Route::controller(PropertyController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/properties/create', 'create');
    Route::get('/properties/search', 'search');
    Route::get('/properties/{property}', 'show');
    Route::get('/properties/{property}/edit', 'edit');

    Route::middleware(['auth'])->group(function () {
        Route::post('/properties', 'store');
        Route::patch('/properties/{property}', 'update');
        Route::delete('/properties/{property}', 'destroy');
        Route::post('/properties/{property}/reports', 'createReport');
        Route::post('/properties/{property}/reviews', 'createReview');
    });
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::get('/users/{user}/edit', 'edit');

    Route::middleware(['auth'])->group(function () {   
        Route::patch('/users/{user}', 'update');
        Route::post('/properties/{property}/favourites', 'createFavouritedProperty');
        Route::post('/users/{user}/request-call-back', 'requestCallBack');
        Route::post('/users/{user}/reviews', 'createReview');
    });
});

Route::post('/analytics', [AnalyticsController::class, 'store']);

Route::controller(FilePondController::class)->group(function () {
    Route::post('/filepond/process', 'process');
    Route::delete('/filepond/revert', 'revert');

    Route::middleware(['auth'])->group(function () {   
        Route::get('/filepond/load/{propertyMedia}', 'load');
        Route::delete('/filepond/remove/{propertyMedia}', 'remove');
    });
});

Route::post('keep-csrf-token-alive', function() {
    return 'Token must have been valid, and the session expiration has been extended.';//https://stackoverflow.com/q/31449434/470749
});

require __DIR__.'/auth.php';
