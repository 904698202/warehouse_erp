<?php

namespace app\login\controller;
use think\Controller;
use app\common\service\User as UserService;
class Login extends Controller
{
    function login(){
        $account = input('username');
        $password = input('password');
        $result = (new UserService())->login($account,$password);
        if ($result){
            $this->success('登录成功');
        }else{
            $this->error('用户名或密码错误，请重新输入');
        }
    }

    function logout(){
        session('user',null);
        $this->result("退出登录成功",1);
    }
}