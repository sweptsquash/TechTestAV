<?php

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteRefreshController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('quotes')->name('quotes.')->group(function () {
        Route::get('', QuoteController::class)->name('index');
        Route::get('refresh', QuoteRefreshController::class)->name('refresh');
    });
});
