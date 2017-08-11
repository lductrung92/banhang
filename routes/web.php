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
    return view('page_home.index');
});
Route::get('/login', ['as' => 'getLoginAdmin', 'uses' => 'Administrator\AuthController@index']);

Route::group(['prefix' => 'administrator', 'middleware' => 'language'], function() {

    Route::get('chooser/language/{lang}', ['as' => 'chooserLanguage', 'uses' => 'Administrator\BaseAdminController@chooser']);
    
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

        /** datatable server side */
        Route::post('/allproducts', ['as' => 'allproducts', 'uses' => 'Administrator\ProductController@allproducts']);

        Route::get('/insert', ['as' => 'getInsertProduct', 'uses' => 'Administrator\ProductController@showFormInsert']);
        Route::post('/insert', ['as' => 'postInsertProduct', 'uses' => 'Administrator\ProductController@insert']);
        Route::get('/viewImages/{id}', ['as' => 'viewImages', 'uses' => 'Administrator\ProductController@viewImages']);

        Route::get('/update/{id}', ['as' => 'getUpdateProduct', 'uses' => 'Administrator\ProductController@showFormUpdate']);
        Route::get('view/images/{id}', ['as' => 'server_image', 'uses' => 'Administrator\ProductController@viewUpdateImages']);
        Route::post('/update/{id}', ['as' => 'postUpdateProduct', 'uses' => 'Administrator\ProductController@update']);

        Route::get('/delete/{id}', ['as' => 'getDeleteProduct', 'uses' => 'Administrator\ProductController@delete']);
    });


    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/', 'Administrator\FileManagerController@show');
        Route::post('/upload', 'Administrator\FileManagerController@upload');
    });

    Route::group(['prefix' => 'upload'], function () {
        Route::get('fileImage/updateSize', ['as' => 'update_size', 'uses' => 'Administrator\FileManagerController@getUploadSize']);
        Route::post('fileImage', ['as' => 'upload_image', 'uses' => 'Administrator\FileManagerController@postUpload']);
       
        /** reload image in view insert product*/
        Route::get('fileImage/reload', 'Administrator\FileManagerController@reload');

        /** reload image in view update product*/
        Route::get('fileImage/update/reload', 'Administrator\FileManagerController@reloadUpdate');
    });

});


