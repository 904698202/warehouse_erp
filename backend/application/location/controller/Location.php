<?php


namespace app\location\controller;

use think\Controller;
use app\common\service\Location as LocationService;
use app\common\validate\locationValidate;
class Location extends Controller
{
    function index(){
        $data = (new LocationService())->page();
        $this->result($data,1,"获取数据成功");
    }

    function save(){
        $data = input();
        $validate = new locationValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else {
            (new LocationService())->create($data);
        }
        return $this->success('添加库位信息成功！','index');
    }

    /*
     * 删除功能
     */
    function delete($id){
        $result = (new LocationService())->delete($id);
        if ($result){
            (new LocationService())->deleteShelve($id);
        }
        return $this->success('删除库位信息成功！','index');
    }

    /*
     * 修改功能
     */
    function edit($id){
        $oneLocation = (new LocationService())->getOne($id);
        if ($oneLocation){
            $storage = db('storage')->where('id',$oneLocation->storage_id)->find();
            $location = db('location')->where('location_id',$id)->find();
            $totalData = array_merge($location,$storage);
            $this->result($totalData,1,"获取库位信息成功！");
        }else{
            $this->result('',0,'获取库位信息失败');
        }
    }

    function update(){
        $data = input();
        $validate = new locationValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else {
            (new LocationService())->update($data);
        }
        return $this->success('修改库位信息成功！','index');
    }

    function find($id){
        $location = (new LocationService())->getOne($id);
        $this->result($location,1,"获取库位信息成功");
    }
}