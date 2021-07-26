<?php

namespace app\Storage\controller;
use app\common\service\Storage as StorageService;
use app\common\service\Location as LocationService;
use think\Controller;
use app\common\validate\storageValidate;

class Storage extends Controller
{
    function index(){
        $data = (new StorageService())->page(input());
        $this->result($data,1,"获取数据成功");
    }

    //创建产品类别功能
    function create(){
        return view();
    }

    function save(){
        $data = input();
        $validate = new storageValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new StorageService())->create($data);
        }
        return $this->success('新建仓库成功！','index');
    }


    //删除
    function delete($id){
        $result = (new StorageService())->delete($id);
        if ($result){
            (new StorageService())->deleteLocation($id);
        }
        return $this->success('删除仓库成功!','index');
    }

    //修改
    function edit($id){
        $storage = (new StorageService())->getOne($id);
        $this->result($storage,1,"获取仓库信息成功");
    }

    function update(){
        $data = input();
        $validate = new storageValidate();
        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }else{
            (new StorageService())->update($data);
        }
        return $this->success('修改仓库信息成功！','index');
    }

}