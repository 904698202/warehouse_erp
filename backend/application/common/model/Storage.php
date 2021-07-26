<?php


namespace app\common\model;


use think\Model;
use think\model\concern\SoftDelete;

class Storage extends Model
{
    use SoftDelete;
    protected $deleteTime = 'storage_delete_time';
    protected $createTime = 'storage_create_time';
    protected $updateTime = 'storage_update_time';
}