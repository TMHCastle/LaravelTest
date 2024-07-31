<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DBController extends Controller
{
    // 定义增删改查的路由先
    // 增
    // insert既支持添加一条也支持多条，既支持一维数组也支持二维数组
    public function add(){
        $db = DB::table('person');// 表名
        // 使用insert添加数据
        $db->insert([[
            'ne' => 'A',
            'age' => '1',
            'email' => 'A@example.com'
        ],[
            'ne' => 'B',
            'age' => '2',
            'email' => 'B@example.com'
        ],]);
        echo '添加数据成功!';

        $result = $db -> insertGetId([
            'ne' => 'C',
            'age' => '3',
            'email' => 'C@example.com'
        ]); // 获取自增ID
        echo '自增ID:'. $result;
        // dd($result);
    }

    // 改
    // update、increment、decrement
    // update：修改所有符合条件的数据
    // increment：修改所有符合条件的数据，并将某一列的值加上指定的值(典型应用：记录登录次数)
    // decrement：修改所有符合条件的数据，并将某一列的值减去指定的值
    // ->where()->update(['age' => 18]);
    public function update(){
        $db = DB::table('person');
        $result = $db->where('id', 1)->update([
            'age' => 18
        ]);
        echo '修改：'. $result;
    }

    public function increment(){
        $db = DB::table('person');
        $result = $db->where('id', 5)->increment('age', 5);
        echo '自增：'. $result;
    }

    public function decrement(){
        $db = DB::table('person');
        $result = $db->where('id', 6)->decrement('age', 1);
        echo '自减：'. $result;
    }

    // 查
    // select
    // get：查询所有符合条件的数据
    public function get(){
        // DB:table['member']->get();，相当于select * from member;返回值是一个集合对象
        $db = DB::table('person');
        $result = $db->get();
        
    }

}
