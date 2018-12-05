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

    public function getDustbinInfo()
    {
        $sql='select jdi.*,jc.cap_imei,ja1.area_name city,ja2.area_name area,ja3.area_name street from jh_dustbin_info jdi left join jh_area ja1 on jdi.area_id0=ja1.area_id ';
        $sql.='left join jh_area ja2 on  jdi.area_id1=ja2.area_id left join jh_area ja3 on jdi.area_id2=ja3.area_id left join jh_cap jc on jdi.cap_id=jc.cap_id';
        $res=Db::query($sql);
        return $res;
    }

    public function queryDevice($type,$state,$addr)
    {
        $sql='select jh.*,ja1.area_name city,ja2.area_name area,ja3.area_name street from jh_cap jh join jh_area ja1 on jh.cap_city=ja1.area_id join jh_area ja2 on jh.cap_area=ja2.area_id join jh_area ja3 on jh.cap_street=ja3.area_id where cap_type='.$type.' and (';
        $where1='';
        foreach($state as $val)
        {
            $where1.='cap_status='.$val.' or ';
        }
        $where1=substr($where1,0,-3);
        $sql.=$where1.')';
        if(is_array($addr)){
            if($addr[2]<0){//表明查询全部区域
                $sql.=' and cap_area='.$addr[1];
            }else{
                $sql.=' and cap_street='.$addr[2];
            }
        }
        $sql.=' order by cap_imei limit 500';
//        return $sql;
        return Db::query($sql);
    }



}