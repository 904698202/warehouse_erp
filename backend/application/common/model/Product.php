<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Product extends Model
{
    protected $pk = 'product_id';
    use SoftDelete;
    protected $deleteTime = 'product_delete_time';
    protected $createTime = 'product_create_time';
    protected $updateTime = 'product_update_time';
}
