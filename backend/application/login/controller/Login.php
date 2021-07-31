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
        if ($result!=null){
            $token = $this->request->token('loginToken','sha1');
            $userinfo = array('userinfo'=>$result,'token'=>$token);
            $this->result($userinfo,1,'登录成功','json');
        }else{
            $this->error('用户名或密码错误，请重新输入');
        }
    }

    function logout(){
        $this->result(null,1,'注销成功，欢迎下次使用！');
    }
}

