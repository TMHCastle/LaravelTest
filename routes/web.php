<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    # return view('welcome');
    echo 'test';
});

// function回调
Route::get('/home', function () {
    echo 'test2';
}) ->name('home');

Route::get('/1', function () {
    echo '1';
}) ->name('1');

// Route::match(['get','post'], function () {

// });

Route::group(['prefix'=>'admin'], function () {
    Route::get('/login', function () {
        echo 'admin login';
    })->name('admin.login');

    Route::get('/index', function () {
        echo 'admin index';
    })->name('admin.index');
});

// 控制器路由
Route::get('/home/index/index', 'Home\IndexController@index');