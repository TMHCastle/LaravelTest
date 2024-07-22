<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //测试Admin分组的Index方法
    public function index(){
        echo 'This is Admin Index Page!';
    }
}
