<?php


namespace app\common\service;
use app\common\model\Shelve as ShelveModel;
use think\db\Where;


class Shelve
{
    function page(){
        $data = input();
        if($data){
            $where = [
                'shelve_name' => ['like','%'.$data['shelve_name'].'%']
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'location_create_time' =>['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }

        return empty($where)?
            ShelveModel::withTrashed()->alias('s')->leftJoin('location','s.shelve_location_id=location.location_id')
                ->order('shelve_id','asc')->select():
            ShelveModel::withTrashed()->alias('s')->leftJoin('location','s.shelve_location_id=location.location_id')
            ->where(new Where($where))->order('shelve_id','asc')->select();
    }

    function create($data){
        return ShelveModel::create($data);
    }

    function delete($id){
        return ShelveModel::destroy($id);
    }

    function getOne($id){
        return ShelveModel::get($id);
    }

    function update($data){
        return ShelveModel::update($data);
    }
}