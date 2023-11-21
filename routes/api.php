<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    LoginController ,
    Role\RoleController,
    User\UserController,
    Status\StatusController,
    RoomType\RoomTypeController,
    Room\RoomController,
    Order\OrderController
};

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


Route::prefix('v1/admin')->group(function() {

    // guest client - admin - employee
    Route::group(['middleware' => 'guest'], function() {
        Route::controller(LoginController::class)->group(function () {
            // login
            Route::post("/login", 'login');
        });
    });

    Route::group(['middleware' => 'auth:api'], function() {

        // login
        Route::controller(LoginController::class)->group(function () {
            Route::post("/profile", 'profile');
            Route::post("/logout", 'logout');
        });

        // Role
        Route::prefix('role')->controller(RoleController::class)->group(function () {
            Route::get("/", 'get');
            Route::get("/getDropdown", 'getDropdown');
            Route::get("/get-permission-dropdown", 'getPermissionDropdown');
            Route::post("/", 'create');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'delete');
        });

        // User
        Route::prefix('user')->controller(UserController::class)->group(function () {
            Route::get("/", 'get');
            Route::get("/getDropdown", 'getDropdown');
            Route::post("/", 'create');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'delete');
        });

        // Status
        Route::prefix('status')->controller(StatusController::class)->group(function () {
            Route::get("/", 'get');
            Route::post("/", 'create');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'delete');
        });

        // room type
        Route::prefix('room-types')->controller(RoomTypeController::class)->group(function () {
            Route::get("/", 'get');
            Route::post("/", 'create');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'delete');
        });

        // room
        Route::prefix('room')->controller(RoomController::class)->group(function () {
            Route::get("/", 'get');
            Route::get("/getDropdown", 'getDropdown');
            Route::post("/", 'create');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'delete');
        });

        // order
        Route::prefix('order')->controller(OrderController::class)->group(function () {
            Route::get("/", 'get');
            Route::post("/", 'create');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'delete');
        });

    });


});
