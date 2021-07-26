<?php
namespace app\common\validate;
use think\Validate;

class categoryValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
        'name' => 'require|min:2|max:20'
    ];

    protected $message = [
        'name.require' => '产品类别名不为空',
        'name.min' => '产品类别名长度不少于2',
        'name.max' => '产品类别名长度不多于20'
    ];

}