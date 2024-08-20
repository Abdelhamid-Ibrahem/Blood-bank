<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::get('governorates', [MainController::class, 'governorates']);
    Route::get('cities', [MainController::class, 'cities']);
    Route::get('blood-types', [MainController::class, 'bloodTypes']);
    Route::get('categories', [MainController::class, 'categories']);
    Route::get('logs', [MainController::class, 'logs']);

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [AuthController::class, 'reset']);
    Route::post('new-password', [AuthController::class, 'password']);



    Route::middleware('auth:api')->group(function () {

        Route::post('register-token', [AuthController::class, 'registerToken']);
        Route::post('remove-token', [AuthController::class, 'removeToken']);
        Route::post('profile', [AuthController::class, 'profile']);

        Route::get('settings', [MainController::class, 'settings']);
        Route::post('contact', [MainController::class, 'contact']);

        Route::get('posts', [MainController::class, 'posts']);
        Route::get('donation-requests', [MainController::class, 'donationRequests']);
        Route::post('donation-request-create', [MainController::class, 'donationRequestCreate']);
        Route::post('report', [MainController::class, 'report']);

        Route::post('post-toggle-favourite', [MainController::class, 'postFavourite']);
        Route::get('my-favourites', [MainController::class, 'myFavourites']);

        Route::get('notifications-count', [MainController::class, 'notificationsCount']);
        Route::get('notifications', [MainController::class, 'notifications']);
        Route::post('notifications-settings', [AuthController::class, 'notificationsSettings']);
        Route::get('test-notification', [MainController::class, 'testNotification']);
    });

});

