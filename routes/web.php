<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ($id = '', $name = '') {
    # return view('welcome');
    echo 'test<br>';
    echo '当前用户的id是：'.request('id').', 名称是：'.request('name');
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

// 传参
// 通过问号传参
// http://localhost/user/show?id=1&name=tom
Route::get('/user/show',function($id = '', $name = ''){
    echo '当前用户的id是：'.request('id').', 名称是：'.request('name');
});

// 传参
// 通过定义参数传参
// http://localhost/user/show/1/tom
Route::get('/user/show/{id}/{name}', function($id, $name){
    echo '当前用户的id是：'.$id.', 名称是：'.$name;
});