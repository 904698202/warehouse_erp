<?php

namespace app\base\controller;
use think\Controller;

class Base extends Controller
{
    protected function initialize()
    {
        dump(\session('user'));
        if (!session('user')){
            return $this->error("请先登录");
        }
    }
}