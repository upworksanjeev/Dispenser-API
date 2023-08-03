<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispenserController;
use App\Http\Controllers\AuthController;
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

Route::middleware(['token','auth:api'])->group(function () {
    Route::post('dispensers', [DispenserController::class, 'create']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::post('dispensers/open/{dispenser}', [DispenserController::class, 'openDispenser']);
Route::post('dispensers/close/{attendee}', [DispenserController::class, 'closeDispenser']);
Route::get('dispensers/{dispenser}/usage', [DispenserController::class, 'getUsage']);
Route::get('dispensers/report', [DispenserController::class, 'getReport']);
