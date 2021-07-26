<?php

namespace app\product\controller;
use app\common\service\Product as ProductService;
use think\Controller;
use app\common\validate\productValidate;

class Product extends Controller
{
    /**
     * @return \think\response\View
     * 货物管理主页
     */
    function index(){
        $data = (new ProductService())->page(input());
        $this->result($data,1,"获取数据成功");
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
        $validate = new productValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new ProductService())->create($data);
        }
        return $this->success('添加产品成功！','index');
    }

    /*
     * 删除功能
     */
    function delete($id){
        (new ProductService())->delete($id);
        return $this->success('删除货物成功！','index');
    }

    /*
     * 修改功能
     */
    function edit($id){
        $oneProduct = (new ProductService())->getOne($id);
        if ($oneProduct){
            $category = db('category')->where('id',$oneProduct->category_id)->find();
            $product = db('product')->where('product_id',$id)->find();
            $totalData = array_merge($category,$product);
            $this->result($totalData,1,'获取产品信息成功');
        }else{
            $this->result('',0,'获取产品信息失败');
        }
    }

    function update(){
        $data = input();
        $validate = new productValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new ProductService())->update($data);
        }
        return $this->success('修改产品信息成功！','index');
    }

}