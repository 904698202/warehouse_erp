<?php
namespace app\common\service;
use app\common\model\Product as ProductModel;
use think\db\Where;

class Product
{
    function getOne($id){
        return ProductModel::find($id);
    }

    function page(){
        $data = input();
        if ($data){
            $where = [
                'product_name' =>['like','%'.$data['product_name'].'%'],
                'name' =>['like','%'.$data['category_name'].'%'],
                'product_shelve_name' =>['like','%'.$data['product_shelve_name'].'%']
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'create_time' =>['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }

        return empty($where)?
            ProductModel::alias('p')->leftJoin('category','p.category_id=category.id')
                ->order('product_id','asc')->select():
            ProductModel::alias('p')->leftJoin('category','p.category_id=category.id')
                ->where(new Where($where))->order('product_id','asc')->select();

//        return LocationModel::withTrashed()
//            ->alias('l')->leftJoin('storage','l.storage_id=storage.id')
//            ->where(new Where($where))->order('location_id','asc')->select();

    }

    /**
     * @param $data
     * @return ProductModel
     * 创建货物
     */
    function create($data){
        return ProductModel::create($data);
    }

    /**
     * @param $id
     * @return bool
     * 删除货物（软删除）
     */
    function delete($id){
        return ProductModel::destroy($id);
    }

    function update($data){
        return ProductModel::update($data);
    }
}
