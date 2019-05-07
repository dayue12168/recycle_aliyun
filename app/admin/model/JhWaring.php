<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2019/5/7
 * Time: 10:10
 */

namespace app\admin\model;

use think\Model;
class JhWaring extends Model
{
    public function getLevelAttr($val)
    {
        $status=[1=>'普通级',2=>'紧急级'];
        return $status[$val];
    }
}