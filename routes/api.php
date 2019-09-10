<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->name('api.v1.')->namespace('Api\V1')->group(function () {
    Route::name('status')->get('/status', function () {
        return response()->json(['status' => 'OK']);
    });


    Route::apiResource('posts', 'PostController');
    Route::apiResource('posts.comments', 'PostCommentController')->only('store', 'index');
    
    Route::namespace('Auth')->group(function () {
        Route::post('register', 'RegisterController@register')->name('register');
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('logout', 'LogoutController@logout')->middleware('auth:api')->name('logout');
    });

    Route::fallback(function () {
        return response()->json([
            'message' => 'Not found'
        ], 404);
    })->name('fallback');
    
});

