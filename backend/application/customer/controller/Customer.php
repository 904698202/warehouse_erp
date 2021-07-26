<?php
namespace app\customer\controller;
use app\base\controller\Base;
use app\common\service\Customer as CustomerService;
use app\common\validate\customerValidate;
use think\Controller;

class Customer extends Controller
//    extends Base
{
    /**
     * @return \think\response\View
     * 顾客管理主页
     */
    function index(){
        $data = (new CustomerService())->page();
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
        $validate = new customerValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new CustomerService())->create($data);
        }
        return $this->success('添加顾客成功！','index');
    }

    /*
     * 删除功能
     */
    function delete($id){
        (new CustomerService())->delete($id);
        return $this->success('删除顾客成功！','index');
    }

    /*
     * 修改功能
     */
    function edit($id){
        $customer = (new CustomerService())->getOne($id);
        $this->result($customer,1,'获取顾客数据成功');
    }

    function update(){
        $data = input();
        $validate = new customerValidate();
        if (!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new CustomerService())->update($data);
        }
        return $this->success('修改顾客成功！','index');
    }

}