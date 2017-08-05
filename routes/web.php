<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'administrator'], function() {
    Route::get('/login', ['as' => 'getLoginAdmin', 'uses' => 'Administrator\AuthController@index']);
    Route::get('/dashboard', ['as' => 'pageIndexAdmin', 'uses' => 'Administrator\BaseAdminController@index']);

    Route::group(['prefix' => 'category'], function() {
        Route::get('/', ['as' => 'pageCateIndex', 'uses' => 'Administrator\CateController@index']);
        Route::post('/insert', ['as' => 'postInsertCate', 'uses' => 'Administrator\CateController@postInsert']);
        Route::post('/update/{id}', ['as' => 'postUpdateCate', 'uses' => 'Administrator\CateController@postUpdate']);

        Route::get('/delete/{id}', ['as' => 'getDeleteCate', 'uses' => 'Administrator\CateController@getDeleteCate']);

        Route::post('/ajax/update', ['as' => 'ajaxUpdateCate', 'uses' => 'Administrator\CateController@ajaxPostInsert']);
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', ['as' => 'pageProductIndex', 'uses' => 'Administrator\ProductController@index']);
    });
});
