<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => '/auth'], function () {
    Route::post('/register', [AuthController::class, 'registerAccount']);
    Route::post('/login', [AuthController::class, 'loginAuth']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => '/users'], function () {
        Route::get('/my-account', [UserController::class, 'getUserLogin']);
        Route::put('/update/my-account', [UserController::class, 'updateUserLoggedIn']);
        Route::get('/get-user/{id}', [UserController::class, 'getUserById']);
        Route::put('/update/user/{id}', [UserController::class, 'updateUserById']);
        Route::post('/update/avatar', [UserController::class, 'editAvatar']);
        Route::delete('/delete/users/{id}', [UserController::class, 'deleteUserById']);
        Route::post('/request/new', [ContactController::class, 'ContactCreate']);
        Route::get('/request', [ContactController::class, 'getContact']);
        Route::put('/request/update/{id}', [ContactController::class, 'setStatusRequest']);
        Route::get('/request/manager', [ContactController::class, 'getManager']);
        Route::get('/member/request/{type}', [ContactController::class, 'getRequestStatus']);
        Route::get('/time-keep/new', [CalendarController::class, 'createTimeKeep']);
        Route::get('/time-keep/update', [CalendarController::class, 'updateTimeKeep']);
        Route::get('/time-keep/get', [CalendarController::class, 'getTimeKeep']);
        Route::get('/time-keep/getByDay', [CalendarController::class, 'getByDay']);
        Route::get('/time-keep/getWorkTime', [CalendarController::class, 'getWorkTime']);
        Route::get('/exports', [CalendarController::class, 'export']);
    });
});
// xu li tat ca cac route khong ton tai
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'
    ], 404);
});
