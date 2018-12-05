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
    public function device_mana($road)
    {
        $sql='select jh.*,concat(ja1.area_name,"-",ja2.area_name,"-",ja3.area_name) address from jh_cap jh join jh_dustbin_info jdi on jh.cap_id=jdi.cap_id join jh_area ja1 on jdi.area_id0=ja1.area_id join jh_area ja2 on jdi.area_id1=ja2.area_id join jh_area ja3 on jdi.area_id2=ja3.area_id where cap_status=0 and jdi.area_id2='.$road;
        $res=Db::query($sql);
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

    public function queryDevice($type,$status,$addr)
    {
        //查询有绑定垃圾桶信息的
        if(is_array($addr)){
            $sql='select jh.*,concat(ja1.area_name,"-",ja2.area_name,"-",ja3.area_name) address from jh_cap jh join jh_dustbin_info jdi on jh.cap_id=jdi.cap_id join jh_area ja1 on jdi.area_id0=ja1.area_id join jh_area ja2 on jdi.area_id1=ja2.area_id join jh_area ja3 on jdi.area_id2=ja3.area_id where cap_type='.$type.' and cap_status='.$status;
            if($addr[2]<0){//表明查询全部区域
                $sql.=' and jdi.area_id1='.$addr[1];
            }else{
                $sql.=' and jdi.area_id2='.$addr[2];
            }
        }else{
            $sql='select *,case cap_status when 1 then "已禁用" when 2 then "未绑定" end address from jh_cap where cap_type='.$type.' and cap_status='.$status;
        }
        $sql.=' order by cap_imei limit 500';
//        return $sql;
        return Db::query($sql);
    }



}