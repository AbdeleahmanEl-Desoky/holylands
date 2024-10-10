<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {


//Home
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'index']);

//Users
    Route::post('update', [\App\Http\Controllers\UserController::class, 'update']);
    Route::post('change-password', [\App\Http\Controllers\UserController::class, 'change_password']);

//Lessons
    Route::get('lessons', [\App\Http\Controllers\LessonsController::class, 'index']);
    Route::get('lessons-day', [\App\Http\Controllers\LessonsController::class, 'lesson_day']);
    Route::get('lessons/{lesson_id}', [\App\Http\Controllers\LessonsController::class, 'show']);
    Route::post('booking/{lesson_id}', [\App\Http\Controllers\LessonsController::class, 'booking']);
    Route::post('booking-cancel/{lesson_id}', [\App\Http\Controllers\LessonsController::class, 'booking_cancel']);

//Attendance
    Route::get('lessons-attendance', [\App\Http\Controllers\AttendanceController::class, 'show']);
    Route::post('attendance-confirmation/{lesson_id}', [\App\Http\Controllers\AttendanceController::class, 'attendance_confirmation']);

//Notifications
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index']);
    Route::post('/fcm-token', [\App\Http\Controllers\HomeController::class, 'updateToken']);
Route::post('/send-notification',[\App\Http\Controllers\HomeController::class,'notification'])->name('notification');
//Pages
    Route::get('about', [\App\Http\Controllers\PageController::class, 'index']);
    Route::get('policy', [\App\Http\Controllers\PageController::class, 'policy']);

//Horses
    Route::get('horses', [\App\Http\Controllers\HorsesController::class, 'index']);
    Route::post('horses-show/{horse_id}', [\App\Http\Controllers\HorsesController::class, 'show']);
    Route::post('horses-end/{lesson_id}', [\App\Http\Controllers\HorsesController::class, 'horses_end']);

});
