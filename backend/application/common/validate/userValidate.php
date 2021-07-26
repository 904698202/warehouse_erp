<?php
namespace app\common\validate;
use think\Validate;

class userValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
        'username' => 'require|min:4|max:16',
        'password' => 'min:6|max:20',
        'phone' => 'require|number|min:11',
        'email' => 'require|email',
        'truename' => 'require'
    ];

    protected $message = [
        'username.require' => '用户名不为空',
        'username.min' => '用户名长度不少于4',
        'username.max' => '用户名长度不多于16',
        'password.min' => '密码长度不少于6',
        'password.max' => '密码长度不多于20',
        'phone.require' => '电话号码不为空',
        'phone.number' => '电话号码为数字',
        'phone.min' => '电话号码不少于11位',
        'email.require' => '邮箱不为空',
        'email.email' => '邮箱为email地址',
        'truename.require' => '真实姓名不为空'
    ];

}