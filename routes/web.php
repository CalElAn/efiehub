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
Route::get('/add-property', [PropertyController::class, 'create']);
Route::post('/add-property', [PropertyController::class, 'store']);
Route::get('/search-property', [PropertyController::class, 'search']);
Route::get('/show-property/{property}', [PropertyController::class, 'show'])->name('show-property');
Route::post('/report-property/{property}', [PropertyController::class, 'report']);


Route::post('/favourite-property', [UserController::class, 'favouriteProperty']);

Route::post('/add-analytics', [AnalyticsController::class, 'store']);

Route::post('/filepond/process', [FilePondController::class, 'process']);
Route::delete('/filepond/revert', [FilePondController::class, 'revert']);

Route::post('keep-csrf-token-alive', function() {
    return 'Token must have been valid, and the session expiration has been extended.';//https://stackoverflow.com/q/31449434/470749
});

require __DIR__.'/auth.php';
