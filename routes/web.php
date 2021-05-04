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



Route::group(['namespace' => 'Admin','prefix' => 'admin'],function (){

    Route::group(['prefix' => 'admin'],function(){

        Route::any('lists','Admin@lists');
        Route::any('add','Admin@add');
        Route::any('getRole','Admin@getRole');
        Route::any('update','Admin@update');
        Route::any('delete','Admin@delete');
        Route::any('getRoleNameByRoleId','Admin@getRoleNameByRoleId');
        Route::any('getAdminById','Admin@getAdminById');
        Route::any('disable','Admin@disable');
        Route::any('enable','Admin@enable');

    });

    Route::group(['prefix' => 'category'],function(){

        Route::any('categorys','Category@categorys');
        Route::any('lists','Category@get_list');
        Route::any('addTopCategory','Category@addTopCategory');
        Route::any('deleteCategory','Category@deleteCategory');
        Route::any('addSonCategory','Category@addSonCategory');
        Route::any('update','Category@update');

    });


    Route::group(['prefix'=>'article'],function(){

        Route::any('add','Article@add');
        Route::any('list','Article@list');
        Route::any('delete','Article@delete');
        Route::any('edit','Article@edit');
        Route::any('getDefaultById','Article@getDefaultById');

    });

    Route::group(['prefix' => 'rule'],function(){

        Route::any('add','Rule@addRule');
        Route::any('getRule','Rule@getRule');
        Route::any('edit','Rule@edit');
        Route::any('delete','Rule@delete');

    });

    Route::group(['prefix' => 'role'],function(){

        Route::any('add','Role@addRole');
        Route::any('getRole','Role@getRole');
        Route::any('edit','Role@edit');
        Route::any('delete','Role@delete');
        Route::any('getRule','Role@getRule');
        Route::any('getRuleDescByRoleId','Role@getRuleDescByRoleId');

    });


    Route::group(['prefix'=>'upload'],function(){

        Route::any('ueditorUpload','Upload@ueditorUpload');
        Route::any('emptyUpload','Upload@emptyUpload');
        Route::any('elementUploadImg','Upload@elementUploadImg');

    });

});
