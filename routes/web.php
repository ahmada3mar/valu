<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\HomeMiddleware;
use Hyperpay\ConnectIn\Http\Controllers\ConnectInController;
use Hyperpay\ConnectIn\Models\Transaction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/inquiry/{transaction}' , [HomeController::class , "inquiry"])->name('inquiry');
// Route::get('/inquiry' , [HomeController::class , "index"])->middleware(HomeMiddleware::class);
Route::get('/home/next' , [HomeController::class , "next"])->middleware(HomeMiddleware::class);
