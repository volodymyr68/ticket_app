<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cities', CityController::class)->middleware('auth');
Route::resource('vehicle', VehicleController::class)->middleware('auth');
Route::post("vehicle/download", [VehicleController::class, "exportVehicles"])->middleware('auth')->name('vehicle.download');

Route::resource('chats', ChatController::class)->middleware('auth');
Route::resource('messages', MessageController::class)->middleware('auth');
Route::post('chats/{chat}/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('ticket', TicketController::class)->middleware('auth');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::resource('roles', RoleController::class)->middleware('auth');
