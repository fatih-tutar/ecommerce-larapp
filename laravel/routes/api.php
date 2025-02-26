<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']); // Listeleme
    Route::post('/', [OrderController::class, 'store']); // Ekleme
    Route::delete('/{order}', [OrderController::class, 'destroy']); // Silme
});

Route::get('discounts/{order}', [DiscountController::class, 'calculate']); // İndirim hesaplama

