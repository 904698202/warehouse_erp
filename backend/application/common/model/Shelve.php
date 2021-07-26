<?php


namespace app\common\model;


use think\Model;
use think\model\concern\SoftDelete;

class Shelve extends Model
{
    protected $pk = 'shelve_id';
    use SoftDelete;
    protected $deleteTime = 'shelve_delete_time';
    protected $createTime = 'shelve_create_time';
    protected $updateTime = 'shelve_update_time';
}