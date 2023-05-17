<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\StadiumController;
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
    //get all event
    Route::get('/', [EventController::class, 'index']);
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
    // Update event
    Route::put('/{id}', [EventController::class, 'update']);
});

Route::prefix('/matching')->group(function () {

    // get matching from event id
    Route::get('/{id}', [MatchingController::class, 'show']);
    // update mathcing
    Route::put('/{id}', [MatchingController::class, 'update']);
    // create mathcing
    Route::post('/', [MatchingController::class, 'store']);
    // create mathcing
    Route::delete('/{id}', [MatchingController::class, 'destroy']);
});

Route::prefix('/categories')->group(function () {
    // get categories
    Route::get('/', [CategoryController::class, 'index']);
});

Route::prefix('/stadiums')->group(function () {
    // get categories
    Route::get('/', [StadiumController::class, 'index']);
});
