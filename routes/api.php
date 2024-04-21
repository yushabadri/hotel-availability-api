<?php

use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\AgencyController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Auth\AgencyLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes for Different guards Login (to generate token)
Route::get('/login', [LoginController::class, 'login']);
Route::get('admin/login', [AdminLoginController::class, 'login']);
Route::get('agency/login', [AgencyLoginController::class, 'login']);

// Routes for 'V1' Endpoints
Route::prefix('v1')->group(function () {

    // Routes for 'api' guard (users)
    Route::middleware(['jwt.auth'])->group(function () {
        Route::get('hotels/availability', [HotelController::class, 'availability'])->name('availability');
    });

    // Routes for 'admin' guard
    Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
        Route::apiResource('agency', AgencyController::class)->only(['index', 'store']);
        Route::apiResource('property', PropertyController::class)->only(['index', 'store']);
    });

    // Routes for 'agency' guard
    Route::middleware(['agency.auth'])->group(function () {
        Route::apiResource('agency/hotel', HotelController::class)->only(['index', 'store']);
    });
});