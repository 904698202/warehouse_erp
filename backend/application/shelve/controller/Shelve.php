<?php

namespace app\shelve\controller;

use think\Controller;
use app\common\service\Shelve as ShelveService;
use app\common\validate\shelveValidate;
class Shelve extends Controller
{
    function index(){
        $data = (new ShelveService())->page();
        $this->result($data,1,"获取数据成功");
    }

    function save(){
        $data = input();
        $validate = new shelveValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else {
            (new ShelveService())->create($data);
        }
        return $this->success('添加库位信息成功！','index');
    }

    function delete($id){
        (new ShelveService())->delete($id);
        return $this->success('删除库位信息成功！','index');
    }

    function edit($id){
        $oneShelve = (new ShelveService())->getOne($id);
        if ($oneShelve){
            $location = db('location')->where('location_id',$oneShelve->shelve_location_id)->find();
            $shelve = db('shelve')->where('shelve_id',$id)->find();
            $totalData = array_merge($location,$shelve);
            $this->result($totalData,1,"获取库位信息成功！");
        }else{
            $this->result('',0,'获取仓库信息失败');
        }
    }

    function update(){
        $data = input();
        $validate = new shelveValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else {
            (new ShelveService())->update($data);
        }
        return $this->success('修改库位信息成功！','index');
    }

}