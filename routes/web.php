<?php

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



Route::get('/', [\App\Http\Controllers\LinksController::class, 'show'])
    ->name('links.show');

Route::post('/', [\App\Http\Controllers\LinksController::class, 'send'])
    ->name('links.send');

Route::get('/{prefix}', [\App\Http\Controllers\LinksController::class, 'away'])
    ->where('prefix', '\w+')
    ->name('links.away');
