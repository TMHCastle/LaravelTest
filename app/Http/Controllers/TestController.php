<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    // 测试控制器路由使用
    public function test1(){
        phpinfo();
    }

    public function test2(){
        echo Input::get('id','无参数时默认值');
        $all = Input::all();
        var_dump($all);
    }


}
