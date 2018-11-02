<?php
/**
 * Created by PhpStorm.
 * User: dayue
 * Date: 2018/11/2
 * Time: 13:30
 */

namespace app\index\controller;


use think\Controller;
use think\Loader;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();

    }

    public function login()
    {

    }

//    驗證碼
    public function smsValidate()
    {
        if (request()->isAjax()){
            $yzm = input('param.yzm');
            $tel = input('param.tel');
            return model('LoginService','service')->smsValidate($yzm,$tel);
        }
    }
    public function test(){
        $data = [
            'name'=>'thinkphp',
            'email'=>'thinkphp@qq.com'
        ];

        $validate = Loader::validate('User');

        if(!$validate->check($data)){
            dump($validate->getError());
        }else{
            echo '123';
        }
    }
}