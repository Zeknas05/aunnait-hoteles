<?php

use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ServiceController;
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

Route::resource('hotel', HotelController::class)->except('create', 'edit');
Route::resource('room', RoomController::class)->except('create', 'edit');
Route::resource('guest', GuestController::class)->except('create', 'edit');
Route::resource('service', ServiceController::class)->except('create', 'edit');