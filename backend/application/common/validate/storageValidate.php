<?php
namespace app\common\validate;
use think\Validate;

class storageValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
      'storage_name' => 'require|min:4',
      'address' => 'require|min:6|max:9'
    ];

    protected $message = [
      'storage_name.require' => '仓库名不为空',
      'storage_name.min' => '仓库名长度不少于4',
      'address.require' => '仓库地址不为空',
      'address.min' => '仓库地址长度不少于6',
      'address.max' => '仓库地址长度不多于9'
    ];

}