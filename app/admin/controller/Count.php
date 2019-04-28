<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/11/7
 * Time: 20:47
 */

namespace app\admin\controller;

use app\admin\controller\Base;
class Count extends Base
{
    //垃圾数量统计表
    public function trash_number()
    {
        $citys=model('Address','service')->getCitys();
        $city=$citys[0]['area_id'];
        $regions=model('Address','service')->getChildAddr($city);
        $region=$regions[0]['area_id'];
        $roads=model('Address','service')->getChildAddr($region);
        $road=$roads[0]['area_id'];
        $groups=model('Address','service')->getChildAddr($road);
//        dump($citys);
        $this->assign('citys',$citys);
        $this->assign('regions',$regions);
        $this->assign('roads',$roads);
        $this->assign('groups',$groups);
        return $this->fetch();
    }
    //垃圾溢出情况统计表
    public function trash_overflow()
    {
        return $this->fetch();
    }

    //回收效率统计表
    public function recovery()
    {
        return $this->fetch();
    }
}