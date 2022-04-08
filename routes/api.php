<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->namespace('DashBoard')->group(function(){

    Route::post('/login', 'APIAuthController@login')->name('admin.login');
    Route::middleware('checkLogin')->group(function () {
        Route::post('/logout', 'APIAuthController@logout')->name('admin.logout');
    });
    Route::middleware('cors')->group(function () {
        Route::resource('admins' , "AdminController");
        Route::put('configrations', 'ConfigrationController@update');
        Route::resource('articles' , "ArticleController");
        Route::resource('services' , "ServiceController");
        Route::resource('contact-us' , "ContactUsController");
        Route::post('upload-file', 'UploadFileController@uploadFile');
    });

   
});

Route::get('index' , "HomeController@index");
Route::get('articles/{article_id?}' , "HomeController@articles");
Route::post('contact-us' , "DashBoard\ContactUsController@store");
Route::get('configrations', 'HomeController@configrations');