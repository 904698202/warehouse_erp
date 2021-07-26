<?php


namespace app\common\service;
use app\common\model\Storage as StorageModel;
use app\common\model\Location as LocationModel;
use think\db\Where;

class Storage
{
    function page(){
        $data = input();
        if($data){
            $where = [
                'storage_name' => ['like','%'.$data['storage_name'].'%'],
                'address' => ['like','%'.$data['address'].'%']
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'storage_create_time' =>['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }

        return empty($where)?
            StorageModel::withTrashed()->select():
            StorageModel::withTrashed()->where(new Where($where))->select();
    }
    //创建商品类别
    function create($data){
        return StorageModel::create($data);
    }

    //删除商品类别
    function delete($id){
        return StorageModel::destroy($id);
    }

    function getOne($id){
        return StorageModel::find($id);
    }

    function update($data){
        return StorageModel::update($data);
    }

    function deleteLocation($storage_id){
        return LocationModel::destroy(function ($query) use ($storage_id){
            $query->where('storage_id',$storage_id);
        });
    }
}