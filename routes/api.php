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



Route::post('login','AuthController@login')->name('login');
Route::post('register','AuthController@register');
Route::post('refresh', 'AuthController@refresh');
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('user','AuthController@getAuthUser');
    Route::get('test','ProductController@test');
    Route::post('product','ProductController@store');
    Route::get('my_product','ProductController@showAuthUserProduct');
    Route::post('all_product','ProductController@index');
    Route::get('show/{id}','ProductController@showProduct');
    Route::get('show_my_product/{id}','ProductController@showAuthUserProductDetails');
    Route::delete('delete_my_product/{id}','ProductController@deleteAuthUserProduct');
    Route::put('update_my_product/{id}','ProductController@updateAuthUserProduct');
    
});

