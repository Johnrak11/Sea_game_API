<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
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

Route::prefix('/events')->group(function () {
    // search event by keyword
    Route::get('/search/{keyword}', [EventController::class, 'search']);
    //get event by id
    Route::get('/{id}', [EventController::class, 'show']);
    // booking ticket
    Route::post('/booking', [BookingController::class, 'store']);
    //Create event
    Route::post('/', [EventController::class, 'store']);
    // Delete event
    Route::delete('/{id}', [EventController::class, 'destroy']);
});
