<?php
namespace app\common\validate;
use think\Validate;

class locationValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
        'location_name' => 'require',
        'storage_id' => 'require',
        'desc' => 'max:200'
    ];

    protected $message = [
        'location_name.require' => '货架名不为空',
        'storage_id.require'=> '未选择仓库',
        'desc.max' => '描述最长不得超过200个字'
    ];

}