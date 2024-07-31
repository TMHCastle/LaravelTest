<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DBController;

// 闭包：function

//        方法 地址   返回值
// Route::get($uri, $callback)
// get
// post提交
// put
// patch
// delete
// options

Route::get('/', function ($id = '', $name = '') {
    # return view('welcome');
    echo 'test,当前访问的地址是根目录<br>';
    echo '当前用户的id是：'.request('id').', 名称是：'.request('name');
});

// $callback————function（函数）回调
Route::get('/home', function () {
    echo 'test/home,当前访问的地址是/home';
}) ->name('home');
// ->是别名

Route::get('/1', function () {
    echo 'test/1,当前访问的地址是/1';
}) ->name('1');

// 响应多个请求，通过match方法实现，或者用any响应所有请求
// match方法，这里代表匹配get和post请求
Route::match(['get','post'], '/match', function () {
    echo 'test/match, 当前访问的地址是/match';
}) ->name('match');
// any方法，表示匹配任意请求方式的路由
Route::any('/any', function () {
    echo 'test/any, 当前访问的地址是/any';
}) ->name('any');

//
// 路由参数：给路由传递的参数，通过路由地址中的{参数名}传递
// 分为必选和可选
// 

// 必选参数
Route::get('/parameter/id/{id}', function ($id = 0) {
    echo 'test/parameter/id/{id}, 当前访问的地址是/parameter/{id}，参数是：' . $id;
}) ->name('parameterid');

// 可选
Route::get('/parameter/ifid/{id?}', function ($id = 0) {
    echo 'test/parameter/ifid/{id?}, 当前访问的地址是/parameter/{id?}，参数是' . ($id > 0? $id : '无参数');
}) ->name('parameterifid');

// 简化
Route::get('/parameter', function ($id = 0) {
    echo 'test/parameter, 当前访问的地址是/parameter, 参数是' . $_GET['id'];
}) ->name('parameter');


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

// 测试路由
Route::get('/home/testcontraller', 'TestController@index');

// Route::get('/sitemap', [SitemapController::class, 'index']);
// Route::get('/sitemap/posts', [SitemapController::class,'posts']);
// Route::get('/sitemap/categories', [SitemapController::class,'categories']);
// Route::get('/sitemap/podcasts', [SitemapController::class,'podcasts']);


// 数据库增删改查
Route::group(['prefix'=> '/home/db'], function () {
    Route::get('add', [DBController::class, 'add']);

    Route::get('delete', [DBController::class, 'delete']);

    Route::get('update', [DBController::class, 'update']);
    Route::get('increment', [DBController::class,'increment']);
    Route::get('decrement', [DBController::class,'decrement']);

    Route::get('select', [DBController::class, 'select']);
});
