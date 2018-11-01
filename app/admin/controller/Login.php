<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/10/30
 * Time: 9:29
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
class Login extends Controller
{
    //登录首页
    public function index()
    {
        return $this->fetch();
    }

    //登录验证
    public function loginIn(Request $request)
    {
        echo '<pre>';
        print_r(config());
        die();
        $data=$request->param();
        $res=model('Login','service')->loginCheck($data);
        return json_encode($data);
    }

    //退出登录
    public function loginOut()
    {

    }
}