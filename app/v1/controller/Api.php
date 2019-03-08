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

use lib\aliyun\Demo;
use think\Db;

class Api
{
    private $appKey = "25264176";
    private $appSecret = "c4204a1608924786b6e1ce58ec6d813f";
    //协议(http或https)://域名:端口，注意必须有http://或https://
    // private static $host = "http://api.st-saas.com/api/api.ashx";
    private $host = "https://api.st-saas.com/API/api.ashx";

    public function bigScreen()
    {
        $result = $this->bigScreenTemp();
        $res['success'] = 1;
        $res['message'] = '成功';
        $res['sign'] = 'jiuhai';
        $res['result'] = $result;
        // $res='{"success":"1","message":"接口调用成功","sign":"jiuhai","result":{"dustbintotal":"100","binlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],"captotal":"50","caponline":"48","capoffline":"2","offlinelist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],"dust1":"10000","dust7":"70000","overflownum":"2","overflowlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}]}}';
        echo json_encode($res);
    }

    public function getApi()
    {
        $path = "/setGarbageAlert";
        $params = '{
                            "id": "bded4128dc454a03b3d10c45de17b863",
                            "version": "1.0",
                            "tenantId": 2,
                            "apiName": "setGarbageAlert",
                            "request": {
                            "apiVer": "1.0.0"
                            },
                            "params": {
                            "message": "报警内容",
                            "source": "报警来源"
                            }
                        }';
        $demo = new Demo($this->appKey, $this->appSecret, $this->host);
        $res = $demo->doPostString($path, $params);

        return $res;
    }

    public function getAppThing()
    {
        $host = 'https://api.link.aliyun.com';
        $path = "/app/thing/info/get";
        $params = '{
                            "id": "bded4128dc454a03b3d10c45de17b863",
                            "version": "1.0",
                            "request": {
                                "apiVer": "1.0.0"
                            },
                            "params": {
                                "iotId": "D95D242941CE821ECCE4F31A2697"
                            }
                        }';
        $demo = new Demo($this->appKey, $this->appSecret, $host);;
        $res = $demo->doPostString($path, $params);

        return $res;
    }

    public function bigScreenTemp()
    {
    	  //垃圾桶位置清单
        $sql='select max(longitude) as longitude,max(latitude) as latitude from jh_dustbin_info ';
        $sql.='where dustbin_state=0 group by dust_serial';
        $res=Db::query($sql);
        $result['dustbintotal']=count($res);
        $result['binlist']=$res;

        //设备总数，在线设备数，离线设备数
        $sql='select count(*) totalcap,sum(case when cap_isonline=0 then 1 else 0 end) as online,';
        $sql.='sum(case when cap_isonline=1 then 1 else 0 end) as offline from jh_cap where cap_status=0';
				$res=Db::query($sql);
				$result['captotal']=$res[0]['totalcap'];
				$result['caponline']=$res[0]['online'];
				$result['capoffline']=$res[0]['offline'];

				//离线设备清单
        $sql='select distinct jdi.longitude,jdi.latitude from jh_dustbin_info jdi join jh_cap jc on jc.cap_id=jdi.cap_id';
        $sql.=' where jdi.dustbin_state=0 and jc.cap_status=0 and jc.cap_isonline=1';
        $res=Db::query($sql);
        $result['offlinelist']=$res;

        //最近1天，7天垃圾数量
        $enddate=date("Y-m-d",strtotime("now"));
        $startdate1=date("Y-m-d",strtotime("-1 day",strtotime("now")));
        $startdate7=date("Y-m-d",strtotime("-7 day",strtotime("now")));
        $sql="select ifnull(sum(dust_num),0) as dustnum1 from jh_rubbish_record where dust_date>='".$startdate1."' and dust_date<'".$enddate."'";
        $res=Db::query($sql);
        $result['dust1']=$res[0]['dustnum1'];
        $sql="select ifnull(sum(dust_num),0) as dustnum7 from jh_rubbish_record where dust_date>='".$startdate7."' and dust_date<'".$enddate."'";
        $res=Db::query($sql);
        $result['dust7']=$res[0]['dustnum7'];

        //满溢垃圾桶位置清单
        $sql='select max(longitude) as longitude,max(latitude) as latitude from jh_dustbin_info ';
        $sql.='where dustbin_state=0 and dustbin_overflow=1 group by dust_serial';
        $res=Db::query($sql);
        $result['overflownum']=count($res);
        $result['overflowlist']=$res;

        return $result;
    }
}
