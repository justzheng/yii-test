<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/1/24
 * Time: 15:35
 */

namespace common\service;


class UserService
{
    public function test($a=1,$b=1) {
        //你的逻辑
        $c = $a+$b;
        return $c;
       //return 123;
    }

    public function testSum($data) {
        //你的逻辑
        return $data;
    }

    function hello($name) {
        return "Hello $name!";
    }

    function sum($a, $b, $c) {
        return $a + $b + $c;
    }
}