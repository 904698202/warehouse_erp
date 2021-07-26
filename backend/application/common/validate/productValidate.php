<?php


namespace app\common\validate;
use think\Validate;

class productValidate extends Validate
{
    protected $batch = true;
    protected $rule = [
        'product_name' => 'require|min:2|max:16',
        'category_id' => 'require',
        'product_shelve_name' => 'require',
        'product_num' => 'require|number',
        'product_price' => 'require'
    ];

    protected $message = [
        'product_name.require' => '产品名不为空',
        'product_name.min' => '产品名长度不少于2',
        'product_name.max' => '产品名长度不多于16',
        'category_id.require' => '产品类别不为空',
        'product_shelve_name.require'=> '货架名不为空',
        'product_num.require' => '产品数量不为空',
        'product_num.number' => '产品数量为数字',
        'product_price.require' => '产品价格不为空'
    ];

}