<?php

use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hotel/all', [HotelController::class, 'all']);
Route::get('room/all', [RoomController::class, 'all']);
Route::get('guest/all', [GuestController::class, 'all']);
Route::get('service/all', [ServiceController::class, 'all']);

Route::get('hotel/{hotel}/rooms', [HotelController::class, 'rooms']);
Route::get('hotel/{hotel}/services', [HotelController::class, 'services']);
Route::get('room/{room}/guests', [RoomController::class, 'guests']);

Route::resource('hotel', HotelController::class)->except('create', 'edit');
Route::resource('room', RoomController::class)->except('create', 'edit');
Route::resource('guest', GuestController::class)->except('create', 'edit');
Route::resource('service', ServiceController::class)->except('create', 'edit');