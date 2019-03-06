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
 */
namespace app\v1\controller;
use think\Db;
class Api
{
    public function bigScreen()
    {
    	call bigScreenTemp();
        $res='{"success":"1","message":"接口调用成功","sign":"jiuhai","result":{"dustbintotal":"100","binlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],"captotal":"50","caponline":"48","capoffline":"2","offlinelist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}],"dust1":"10000","dust7":"70000","overflownum":"2","overflowlist":[{"longitude":"123.12","latitude":"456.45"},{"longitude":"321.32","latitude":"654.65"}]}}';
        return $res;
    }

    public function bigScreenTemp()
    {
    	  
        $sql='select dust_serial,max(longitude) as longitude,max(latitude) as latitude from jh_dustbin_info where dustbin_state=0';
        $res=Db::query($sql);
        print_r($res); 
        //return json_encode($res);
    }
}