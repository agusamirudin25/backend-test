<?php

use App\Http\Controllers\ConnoteController;
use App\Http\Controllers\PackageController;
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

Route::prefix('v1')->group(function () {
    // connotes
    Route::get("connotes", ConnoteController::class);

    Route::get("packages", [PackageController::class, 'index']);
    Route::get("package/{id}", [PackageController::class, 'show']);
    Route::post("package", [PackageController::class, 'store']);
    Route::put("package/{id}", [PackageController::class, 'update']);
    Route::patch("package/{id}", [PackageController::class, 'updatePatch']);
    Route::delete("package/{id}", [PackageController::class, 'destroy']);
});