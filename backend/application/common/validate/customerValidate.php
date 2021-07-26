<?php
namespace app\common\validate;
use think\Validate;

class customerValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
        'name' => 'require',
        'telphone' => 'require|number|min:11',
        'email' => 'require|email',
        'address' => 'require|min:6|max:9'
    ];

    protected $message = [
        'name.require' => '姓名不为空',
        'telphone.require' => '电话号码不为空',
        'telphone.number' => '电话号码为数字',
        'telphone.min' => '电话号码不少于11位',
        'email.require' => '邮箱不为空',
        'email.email' => '邮箱为email地址',
        'address.require' => '地址不为空',
        'address.min' => '地址长度不少于6,即某省某市',
        'address.max' => '地址长度不多于9，即某省某市某县'
    ];

}