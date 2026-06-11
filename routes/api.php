<?php

use App\Http\Controllers\MidtransController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// midtrans callback
Route::post('pesanan/callback', [MidtransController::class, 'callback'])->name('midtrans-callback');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
