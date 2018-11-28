<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/11/9
 * Time: 14:41
 */

namespace app\admin\controller;

use think\Request;

class Address
{
    //获取城市下面的区路组列表
    public function getCitys(Request $request)
    {

    }

    //获取某一区域下面的子地区列表
    public function getChildAddr(Request $request)
    {
        $addr=$request->param('addr');
        $res=model('Address','service')->getChildAddr($addr);
        $list=array();
        if(key_exists(0,$res)){
            for($i=$res[0]['area_level'];$i<=3;$i++){
                $list[$res[0]['area_level']]=$res;
//                $list[$res[0][$i]]=$res;
                $temp=model('Address','service')->getChildAddr($res[0]['area_id']);
                if(!$temp && $i<3){
                    array_push($list,[['area_id'=>-1,'area_name'=>'请选择']]);
                }else{
                    $res=$temp;
                }
            }
        }else{
            array_push($list,[['area_id'=>-1,'area_name'=>'请选择']]);
        }
        //将数组重新遍历一遍
        $res=array();
        foreach($list as $val){
            $res[]=$val;
        }
        return json($res);
    }

    //添加某一区域下的子区域
    public function addChild(Request $request)
    {
//        return json($request->param());
        $pid=$request->param('id');
        $name=$request->param('name');
        $res['state']=model('Address','service')->addChild($pid,$name);
        if($res['state']){
            $res['info']=$name.'区域创建成功';
        }else{
            $res['info']=$name.'区域创建失败';
        }
        return json($res);
    }

    //更改地址名
    public function updateName(Request $request)
    {
        $pid=$request->param('id');
        $name=$request->param('name');
        $res['state']=model('Address','service')->updateName($pid,$name);
        if($res['state']){
            $res['info']=$name.'改名成功';
        }else{
            $res['info']=$name.'改名失败';
        }
        return json($res);
    }
}