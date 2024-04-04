<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PermissionController;

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

// Route::apiResource('users', UserController::class);
Route::namespace('Api')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Forgot-password
    |--------------------------------------------------------------------------
    */
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
    Route::get('/mot-de-passe/reinitialiser/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/mot-de-passe/reset/', [AuthController::class, 'reset']);


    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('/helloworld', [AuthController::class, 'index']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::group([
            'middleware' => 'checkRoles:api'
        ], function () {

            /*
        |--------------------------------------------------------------------------
        | CRUD permissions
        |--------------------------------------------------------------------------
        */
            Route::get('/permissions', [PermissionController::class, 'showPermissions']);
            Route::post('/permissions', [PermissionController::class, 'addPermission']);
            Route::put('/permissions/{id}', [PermissionController::class, 'updatePermission']);
            Route::delete('/permissions/{id}', [PermissionController::class, 'deletePermission']);

            /*
        |--------------------------------------------------------------------------
        | CRUD roles
        |--------------------------------------------------------------------------
        */
            Route::get('/roles', [RoleController::class, 'showRoles']);
            Route::post('/roles', [roleController::class, 'addRole']);
            Route::put('/roles/{id}', [RoleController::class, 'updateRole']);
            Route::delete('/roles/{id}', [roleController::class, 'deleteRole']);

            /*
        |--------------------------------------------------------------------------
        | CRUD users
        |--------------------------------------------------------------------------
        */
            Route::get('/users', [UserController::class, 'showUsers']);
            Route::post('/users', [UserController::class, 'addUser']);
            Route::put('/users/{id}', [UserController::class, 'updateUser']);
            Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
        });
    });
});
