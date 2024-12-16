<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\userController;
use App\Http\Controllers\walletController;
use App\Http\Controllers\transactionController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/get-all-users', [userController::class, 'getAllUsers']);
Route::get('/get-all-wallets', [walletController::class, 'getAllWallets']);
Route::get('/wallets/{id}', [walletController::class, 'getWalletDetails']);
Route::post('/wallets/send-money', [transactionController::class, 'sendMoney']);


