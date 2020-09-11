<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth',
        'namespace' => 'Api',
    ], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
        //Image info
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function ($router) {
    Route::get('images', 'ImageInfosController@index');
    Route::post('images', 'ImageInfosController@store');
    Route::put('images/{imageInfos}', 'ImageInfosController@update')->name('update image infos');
    Route::delete('images/{imageInfos}', 'ImageInfosController@delete');
    Route::get('images/{imageInfos}', 'ImageInfosController@detail');
});
