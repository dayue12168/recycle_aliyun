<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/10/30
 * Time: 9:29
 */

namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Session;
use think\Db;

class Login extends Controller
{
    //登录首页
    public function index()
    {
        return $this->fetch();
    }

    //登录验证
    public function loginIn()
    {

    }

    //退出登录
    public function loginOut()
    {

    }
}