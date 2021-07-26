<?php

namespace app\common\service;
use app\common\model\User as UserModel;
use think\db\Where;

class User
{
    function getOne($id){
        return UserModel::find($id);
    }

    function page(){
        $data = input();
        if($data){
            $where = [
                'username' => ['like','%'.$data['username'].'%'],
                'phone' =>['like','%'.$data['phone'].'%'],
                'email' =>['like','%'.$data['email'].'%']
            ];
            if (!empty($data['begin_time'])&&!empty($data['end_time'])){
                $where = array_merge($where,[
                    'create_time' =>['between time',[$data['begin_time'],$data['end_time']]]
                ]);
            }
        }

        return empty($where)?
            UserModel::withTrashed()->select():
            UserModel::withTrashed()->where(new Where($where))->select();
    }

    /**
     * @param $account
     * @param $password
     * @return bool
     * 登录
     */
    function login($account,$password){
        $result = UserModel::where('username',$account)
            ->where('password',$password)
            ->find();
        if($result) session('user',$account);
        return $result!=null;
    }

    /**
     * @param $data
     * @return UserModel
     * 创建用户
     */
    function create($data){
        return UserModel::create($data);
    }

    /**
     * @param $id
     * @return bool
     * 删除用户（软删除）
     */
    function delete($id){
        return UserModel::destroy($id);
    }

    function update($data){
        return UserModel::update($data);
    }

}