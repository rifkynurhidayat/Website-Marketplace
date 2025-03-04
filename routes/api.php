<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/register/check', [RegisterController::class, 'check'])->name('api-register-check');
Route::get('/provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('/regencies/{provinces_id}', [LocationController::class, 'regencies'])->name('api-regencies');

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');
Route::get('/success', [App\Http\Controllers\CheckoutController::class, 'success'])->name('success');


