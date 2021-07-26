<?php


namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Location extends Model
{
    protected $pk = 'location_id';
    use SoftDelete;
    protected $deleteTime = 'location_delete_time';
    protected $createTime = 'location_create_time';
    protected $updateTime = 'location_update_time';
}