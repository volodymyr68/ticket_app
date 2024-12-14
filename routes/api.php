<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ChatApiController;
use App\Http\Controllers\api\CityApiController;
use App\Http\Controllers\api\MessageApiController;
use App\Http\Controllers\api\TicketApiController;
use App\Http\Controllers\api\UserApiController;
use App\Http\Controllers\api\VehicleApiController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\PusherChannelController;
use App\Http\Controllers\VehicleController;
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

//Route::resource('user',UserController::class)->middleware('auth:sanctum');
Route::get("users", [UserApiController::class, "index"])->middleware('auth:sanctum');
Route::post("users", [UserApiController::class, "update"])->middleware('auth:sanctum');

Route::get("vehicle/download", [VehicleController::class, "exportVehicles"]);

Route::resource('cities', CityApiController::class)->middleware('auth:sanctum');

Route::resource('vehicles', VehicleApiController::class)->middleware('auth:sanctum');

Route::resource('chats', ChatApiController::class)->middleware('auth:sanctum');
Route::resource('messages', MessageApiController::class)->middleware('auth:sanctum');

Route::post('chats/{chat}/messages', [MessageApiController::class, 'store'])->name('messages.store')->middleware('auth:sanctum');

Route::resource('tickets', TicketApiController::class)->middleware('auth:sanctum');

Route::post('/tickets/{ticket}/download', [TicketApiController::class, 'downloadTicket']);

Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/login/redirect', [AuthController::class, 'loginRedirect'])->name('login.redirect');

