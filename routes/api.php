<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FieldController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserDataController;

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

// ============================================================
// Public routes (no authentication required)
// ============================================================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Fields (public)
Route::get('/fields', [FieldController::class, 'index']);
Route::get('/fields/{id}', [FieldController::class, 'show']);
Route::get('/fields/{id}/images', [FieldController::class, 'images']);
Route::get('/fields/{id}/schedule', [BookingController::class, 'schedule']);

// Payments (public - for displaying payment info)
Route::get('/payments', [PaymentController::class, 'index']);

// App profile (public)
Route::get('/profile', [ProfileController::class, 'index']);

// ============================================================
// Authenticated routes (Sanctum token required)
// ============================================================

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Bookings (tenant can manage their own)
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    Route::post('/bookings/{id}/upload-proof', [BookingController::class, 'uploadProof']);

    // User data (own profile)
    Route::get('/user-data', [UserDataController::class, 'show']);
    Route::put('/user-data', [UserDataController::class, 'update']);

    // ==========================================================
    // Admin-only routes
    // ==========================================================
    Route::middleware('ceklevel:Admin')->group(function () {

        // Fields management
        Route::post('/fields', [FieldController::class, 'store']);
        Route::post('/fields/{id}', [FieldController::class, 'update']);
        Route::delete('/fields/{id}', [FieldController::class, 'destroy']);
        Route::post('/fields/{id}/images', [FieldController::class, 'storeImage']);
        Route::delete('/fields/{id}/images/{imageId}', [FieldController::class, 'destroyImage']);

        // Booking status management
        Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']);

        // Payments management
        Route::post('/payments', [PaymentController::class, 'store']);
        Route::put('/payments/{id}', [PaymentController::class, 'update']);
        Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);

        // App profile management
        Route::put('/profile/{id}', [ProfileController::class, 'update']);

        // User management
        Route::get('/users', [UserDataController::class, 'listUsers']);
        Route::put('/users/{id}/toggle-status', [UserDataController::class, 'toggleStatus']);
    });
});
