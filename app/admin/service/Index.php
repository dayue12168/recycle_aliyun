<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/11/8
 * Time: 22:15
 */

namespace app\admin\service;

use think\Db;


class Index
{
    public function device_mana()
    {
//        $res=Db::table('jh_cap')->limit(2)->select();
        $res=Db::table('jh_cap')->order('cap_imei')->select();
        return $res;
    }

    public function getTypes()
    {
        $sql='select distinct cap_type from jh_cap';
        $res=Db::query($sql);
        return $res;
    }



}