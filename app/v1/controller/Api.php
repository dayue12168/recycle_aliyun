<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2019/2/28
 * Time: 16:57
 接口示例{"success":"0","message":"失败原因","sign":"jiuhai", "result":{"dustbintotal":"100",
 "binlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],
 "captotal":"50","caponline":"48","capoffline":"2",
 "offlinelist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],
 "dust1":"10000","dust7":"70000","overflownum":"2",
 "overflowlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}]}}
 success:1表示成功
sign:签名，固定为 jiuhai
longitude:经度
latitude:纬度
dustbintotal:垃圾桶总数
binlist:垃圾桶位置清单
captotal:设备总数
caponline:在线设备总数
capoffline:离线设备总数
offlinelist:离线设备位置清单
dust1:最近1天垃圾总
dust7:最近7天垃圾总
overflownum:满溢垃圾桶总数
overflowlist:满溢垃圾桶位置清单
 */
namespace app\v1\controller;
use think\Db;
class Api
{
    public function bigScreen()
    {
    		//call $this->bigScreenTemp();
        $res='{"success":"1","message":"接口调用成功","sign":"jiuhai","result":{"dustbintotal":"100","binlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],"captotal":"50","caponline":"48","capoffline":"2","offlinelist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],"dust1":"10000","dust7":"70000","overflownum":"2","overflowlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}]}}';
        return $res;
    }

    public function bigScreenTemp()
    {
    	/*
    	  //垃圾桶位置清单
        $sql='select dust_serial,max(longitude) as longitude,max(latitude) as latitude from jh_dustbin_info ';
        $sql.='where dustbin_state=0 group by dust_serial';
        $res=Db::query($sql);
        print_r($res);
        //离线设备清单
        $sql='select distinct jdi.longitude,jdi.latitude from jh_dustbin_info jdi join jh_cap jc on jc.cap_id=jdi.cap_id';
        $sql.=' where jdi.dustbin_state=0 and jc.cap_status=0 and jc.cap_isonlilne=1'
        $res=Db::query($sql);
        
        //设备总数，在线设备数，离线设备数
        $sql='select count(*) totalcap,sum(case when cap_isonline=0 then 1 else 0 end) as online,';
        $sql.='sum(case when cap_isonline=1 then 1 else 0 end) as offline from jh_cap where cap_status=0';
        
        //最近1天，7天垃圾数量
        $enddate=date("Y-m-d",strtotime());
        $startdate1=date("Y-m-d",strtotime("-1 day",strtotime()));
        $startdate7=date("Y-m-d",strtotime("-7 day",strtotime()));
        $sql="select sum(dust_num) as dustnum1 from jh_rubbish_record where dust_date>='".$startdate1."' and dust_date<'".$enddate."'";
        $res=Db::query($sql);
        $sql="select sum(dust_num) as dustnum7 from jh_rubbish_record where dust_date>='".$startdate7."' and dust_date<'".$enddate."'";
        $res=Db::query($sql);
        
        //满溢垃圾桶位置清单
         $sql='select dust_serial,max(longitude) as longitude,max(latitude) as latitude from jh_dustbin_info ';
        $sql.='where dustbin_state=0 and dustbin_overflow=1 group by dust_serial';
        $res=Db::query($sql); 
        
        //return json_encode($res);
        */
    }
}