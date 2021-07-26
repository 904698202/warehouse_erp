<?php
namespace app\common\service;

use app\common\model\Category as CategoryModel;
use think\db\Where;

class Category
{


    function page(){
        $data = input();
        if ($data){
            $where = [
                'name' => ['like','%'.$data['name'].'%'],
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'create_time' => ['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }
        return empty($where)?
            CategoryModel::select():
            CategoryModel::where(new Where($where))->select();
    }

    //创建商品类别
    function create($data){
        return CategoryModel::create($data);
    }

    //删除商品类别
    function delete($id){
        return CategoryModel::destroy($id);
    }

    function getOne($id){
        return CategoryModel::find($id);
    }

    function update($data){
        return CategoryModel::update($data);
    }
}