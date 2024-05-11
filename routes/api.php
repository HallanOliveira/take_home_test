<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AccountController::class)->group(function () {
    Route::post('/reset', 'reset')->name('api.account.reset');
    Route::get('/balance', 'getBalance')->name('api.account.balance');
    Route::post('/event', 'eventHandle')->name('api.account.event');
});
