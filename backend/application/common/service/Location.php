<?php


namespace app\common\service;

use think\db\Where;
use app\common\model\Location as LocationModel;
use app\common\model\Shelve as ShelveModel;

class Location
{
    function page(){
        $data = input();
        if($data){
            $where = [
                'location_name' => ['like','%'.$data['location_name'].'%'],
                'storage_name' => ['like','%'.$data['storage_name'].'%'],
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'location_create_time' =>['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }

        return LocationModel::withTrashed()
            ->alias('l')->leftJoin('storage','l.storage_id=storage.id')
            ->where(new Where($where))->order('location_id','asc')->select();

    }

    function create($data){
        return LocationModel::create($data);
    }

    function delete($id){
        return LocationModel::destroy($id);
    }

    function getOne($id){
        return LocationModel::get($id);
    }

    function update($data){
        return LocationModel::update($data);
    }

    function deleteShelve($shelve_location_id){
        return ShelveModel::destroy(function ($query) use ($shelve_location_id){
            $query->where('shelve_location_id',$shelve_location_id);
        });
    }
}