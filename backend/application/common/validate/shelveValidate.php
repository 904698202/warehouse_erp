<?php
namespace app\common\validate;
use think\Validate;

class shelveValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
        'shelve_name' => 'require',
        'shelve_location_desc' => 'max:200'
    ];

    protected $message = [
        'shelve_name.require' => '货架名不为空',
        'shelve_location_desc.max' => '货架描述最长为200个字'
    ];

}