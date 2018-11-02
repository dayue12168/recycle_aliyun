<?php
/**
 * Created by PhpStorm.
 * User: dayue
 * Date: 2018/11/2
 * Time: 14:54
 */

namespace app\index\service;

use lib\api_demo\SmsDemo;
use think\Controller;

class LoginService extends Controller
{
    public function smsValidate($yzm, $tel)
    {
        if (isset($yzm)) {
            // return $tel;
            $smsDemo = new SmsDemo();
            $res = $smsDemo->sendSms($tel);
            if (isset($res)){
                return $res;
            }else{
                return 0;
            }
        }
    }
}