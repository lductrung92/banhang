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
    Route::get('/dashboartuyển tập nhạc bolero hay nhấtd', ['as' => 'pageIndexAdmin', 'uses' => 'Administrator\BaseAdminController@index']);

    Route::group(['prefix' => 'category'], function() {
        Route::get('/', ['as' => 'pageCateIndex', 'uses' => 'Administrator\CateController@index']);
        Route::post('/insert', ['as' => 'postInsertCate', 'uses' => 'Administrator\CateController@postInsert']);
        Route::post('/update/{id}', ['as' => 'postUpdateCate', 'uses' => 'Administrator\CateController@postUpdate']);

        Route::get('/delete/{id}', ['as' => 'getDeleteCate', 'uses' => 'Administrator\CateController@getDeleteCate']);

        Route::post('/ajax/update', ['as' => 'ajaxUpdateCate', 'uses' => 'Administrator\CateController@ajaxPostInsert']);
    });

    Route::group(['prefix' => 'product'], function() {
        Route::get('/', ['as' => 'pageProductIndex', 'uses' => 'Administrator\ProductController@index']);
        Route::get('/insert', ['as' => 'getInsertProduct', 'uses' => 'Administrator\ProductController@showFormInsert']);
    });

    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/', 'Administrator\FileManagerController@show');
        Route::post('/upload', 'Administrator\FileManagerController@upload');
    });

    Route::group(['prefix' => 'upload'], function () {
        Route::get('fileImage/server-images', ['as' => 'server_image', 'uses' => 'Administrator\FileManagerController@getServerImages']);
        Route::get('fileImage/updateSize', ['as' => 'update_size', 'uses' => 'Administrator\FileManagerController@getUploadSize']);
        Route::post('fileImage', ['as' => 'upload_image', 'uses' => 'Administrator\FileManagerController@postUpload']);
        Route::post('fileImage/delete', ['as' => 'delete_image', 'uses' => 'Administrator\FileManagerController@postDelete']);
        Route::get('fileImage/reload', 'Administrator\FileManagerController@reload');
    });

});
