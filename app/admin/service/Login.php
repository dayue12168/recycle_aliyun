<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/11/1
 * Time: 15:51
 */
namespace app\admin\service;

use think\Db;

class Login
{
    protected $key='recycleTest';

    public function loginCheck($data)
    {
//        print_r();
        $res=Db::table('jh_user')->where([
            'tel'=>$data['username'],
            'pwd'=>md5($data['password'])
        ])->column('user_id')->fetchSql(false)->find();
        return $res;
    }
}