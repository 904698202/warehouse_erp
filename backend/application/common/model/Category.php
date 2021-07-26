<?php
namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Category extends Model
{
    use SoftDelete;
    protected $deletetime = 'delete_time';

}