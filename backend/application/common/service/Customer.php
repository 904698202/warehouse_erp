<?php
namespace app\common\service;
use app\common\model\Customer as CustomerModel;
use think\db\Where;

class Customer
{

    function getOne($id){
        return CustomerModel::find($id);
    }

    function page(){
        $data = input();
        if($data){
            $where = [
                'name' =>['like','%'.$data['name'].'%'],
                'telphone' =>['like','%'.$data['telphone'].'%'],
                'email' =>['like','%'.$data['email'].'%']
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'create_time' =>['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }

//        return empty($where)?
//            CustomerModel::select():
//            CustomerModel::where(new Where($where))->select();
        $page = $data['page'];
        $rows = $data['size'];
        $items = CustomerModel::where(new Where($where))->page($page,$rows)->select()->toJson();
        $total = CustomerModel::count();

        $data = [
            'total' =>$total,
            'items' =>$items
        ];
        return $data;
    }


    /**
     * @param $data
     * @return CustomerModel
     * 创建用户
     */
    function create($data){
        return CustomerModel::create($data);
    }

    /**
     * @param $id
     * @return bool
     * 删除用户（软删除）
     */
    function delete($id){
        return CustomerModel::destroy($id);
    }

    function update($data){
        return CustomerModel::update($data);
    }
}
