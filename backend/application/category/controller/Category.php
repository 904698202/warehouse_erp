<?php

namespace app\category\controller;
use app\common\service\Category as CategoryService;
use think\Controller;
use app\common\validate\categoryValidate;

class Category extends Controller
{
    //产品类别管理主页
    function index(){
        $data = (new CategoryService())->page(input());
        $this->result($data,1,"获取数据成功");
    }

    //创建产品类别功能
    function create(){
        return view();
    }

    function save(){
        $data = input();
        $validate = new categoryValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new CategoryService())->create($data);
        }
        return $this->success('添加产品类别成功!','index');
    }

    //删除
    function delete($id){
        (new CategoryService())->delete($id);
        return $this->success('删除产品类别成功!','index');
    }

    //修改
    function edit($id){
        $category = (new CategoryService())->getOne($id);
        if ($category){
            $this->result($category,1,'获取数据成功');
        }else{
            $this->result("",0,'获取数据失败');
        }

    }

    function update(){
        $data = input();
        $validate = new categoryValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new CategoryService())->update($data);
        }
        return $this->success('修改产品类别成功','index');
    }


}