<?php

namespace app\user\controller;
use app\common\service\User as UserService;
use app\common\validate\userValidate;
use think\Controller;

class User extends Controller
{
    /**
     * @return \think\response\View
     * 用户管理主页
     */
    function index(){
        $data = (new UserService())->page();
        $this->result($data,1,"获取数据成功");
    }

    /**
     * @return mixed
     * 用户登录功能
     */
    function toLogin(){
        return $this->fetch('login');
    }

    /**
     * @return \think\response\View
     * 创建用户功能
     */
    function create(){
        return view();
    }

    function save(){
        $data = input();
        $validate = new userValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new UserService())->create($data);
        }
        return $this->success('添加用户成功！','index');
    }

    /*
     * 删除功能
     */
    function delete($id){
        (new UserService())->delete($id);
        $this->success('冻结用户成功！','index');
    }


    /*
     * 修改功能
     */
    function edit($id){
        $user = (new UserService())->getOne($id);
        $this->result($user,1,'获取用户数据成功');
    }

    function update(){
        $data = input();
        $validate = new userValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new UserService())->update($data);
        }
        return $this->success('修改用户成功！','index');
    }
}
