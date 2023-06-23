<?php

use App\Http\Controllers\Api\AssetsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DepartmentController;
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
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => '/users'], function () {

        Route::get('/profile', [UserController::class, 'profile']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
        Route::post('/avatar', [UserController::class, 'editAvatar']);
        Route::get('/{id}', [UserController::class, 'getById']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::put('/{id}/deActive', [UserController::class, 'delete']);
        Route::put('/{id}/active', [UserController::class, 'active']);
        Route::get('', [UserController::class, 'get']);

        //request
        Route::group(['prefix' => '/requests'], function () {
            Route::get('/all', [ContactController::class, 'getByUserLogin']);
            Route::post('', [ContactController::class, 'create']);
            Route::get('/manager', [ContactController::class, 'getManager']);
            Route::get('/{id}', [ContactController::class, 'get']); // popular : user_id => user obj relationship
            Route::patch('/{id}', [ContactController::class, 'setStatus']);
            Route::put('/{id}', [ContactController::class, 'edit']);
            Route::delete('/{id}', [ContactController::class, 'delete']);

            Route::get('/member/{type}', [ContactController::class, 'getStatus']);
        });

        //time keep
        Route::group(['prefix' => '/time-keep'], function () {
            Route::get('/all', [CalendarController::class, 'get']);
            Route::post('/check-in', [CalendarController::class, 'create']);
            Route::put('/check-out', [CalendarController::class, 'update']);
            Route::get('/by-day', [CalendarController::class, 'getByDay']);
            Route::get('/work-time', [CalendarController::class, 'getWorkTime']);
            Route::get('/not-work/{year}/{month}', [CalendarController::class, 'getNotWork']);
        });
        Route::get('/exports', [CalendarController::class, 'export']);

        //asset
        Route::group(['prefix' => '/assets'], function () {
            Route::get('/me', [AssetsController::class, 'getByUserLogin']);
            Route::post('/', [AssetsController::class, 'create']);
            Route::get('/{id}', [AssetsController::class, 'getById']);
            Route::put('/{id}', [AssetsController::class, 'edit']);
        });
    });

    // department
    Route::group(['prefix' => '/departments'], function () {
        Route::get('', [DepartmentController::class, 'get']);
        Route::post('', [DepartmentController::class, 'create']);
        Route::get('/{id}', [DepartmentController::class, 'getById']);
        Route::put('/{id}', [DepartmentController::class, 'edit']);
    });
});

// xu li tat ca cac route khong ton tai
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'
    ], 404);
});
