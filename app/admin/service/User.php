<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/11/7
 * Time: 21:32
 */

namespace app\admin\service;

use think\Db;
class User
{
    //获取其角色名以及权限列表
    public function getRole($tel)
    {
        $sql='select jur.role_name,jur.role_auth from jh_user ju join jh_user_role jur on ju.role_id=jur.role_id where ju.state=0 and ju.tel="'.$tel.'"';
        return Db::query($sql)[0];
    }

    //查询出所有非超级管理员以外的角色
    public function allRoles()
    {
        $sql='select role_id,role_name,role_auth from jh_user_role where role_id<>1 and role_auth<>"*"';
        $roles=Db::query($sql);
        return $roles;
    }

    //查询出所有权限列表
    public function allAuths()
    {
//        $sql='select jra.auth_id pauth_id,jra.auth_name pauth_name,jra1.auth_id,jra1.auth_name from jh_role_auth jra join jh_role_auth jra1 ';
//        $sql.='on jra.auth_id=jra1.parent_id';
//        $sql='select auth_id,auth_name,parent_id from jh_role_auth';
        $sql='select auth_id,auth_name,parent_id from jh_role_auth where auth_id>1';
        $arr=Db::query($sql);
        $auths=array();
        foreach($arr as $val){
            if($val['parent_id']==0){
                $auths[$val['auth_id']]['name']=$val['auth_name'];
            }else{
                $auths[$val['parent_id']][]=['name'=>$val['auth_name'],'auth_id'=>$val['auth_id']];
            }
        }
        return $auths;
    }

    //以个人身份信息获取具体权限信息
    public function getAuth($auth='')
    {
        $arr=explode(',',$auth);
        if(empty($arr[0])){//拥有全部权限
            $sql='select auth_id id,auth_name node,concat("/",module_name,"/",controller_name,"/",action_name) url,parent_id pid from jh_role_auth';
            $list=Db::query($sql);
        }else{//拥有部分权限
            foreach($arr as $val){
                $sql='select auth_id id,auth_name node,concat("/",module_name,"/",controller_name,"/",action_name,".html") url,parent_id pid from jh_role_auth where auth_id='.$val;
                $list[]=Db::query($sql)[0];
            }
        }
        return $list;
    }


    //更改角色权限列表
    public function updateRole($role,$auths)
    {
        $list=explode(',',$auths);
        foreach($list as $val){//
            $id=Db::table('jh_role_auth')->where('auth_id',$val)->value('parent_id');
            if(!in_array($id,$list)){
                $list[]=$id;
            }
        }
        $auths=implode(',',$list);
        $res=Db::table('jh_user_role')->where('role_id',$role)
            ->fetchSql(false)->update([
            'role_auth'=>$auths
        ]);
        return $res;
    }

    //查询所有管理员:默认全部管理员,0代表系统管理员，1代表商户管理员
    public function getAdmin($type=-1)
    {
        $sql='select ju.user_id,ju.tel,ju.user_name,ju.user_type,ju.last_login_time,ju.wx_band,ju.state,jur.role_name,ja1.area_name city,ja2.area_name area,';
        $sql.='ja3.area_name street,ja4.area_name `group` from jh_user ju join jh_user_role jur on ju.role_id=jur.role_id left join ';
        $sql.='jh_area ja1 on ju.area_id0 = ja1.area_id left join jh_area ';
        $sql.='ja2 on ju.area_id1 = ja2.area_id left join jh_area ja3 ';
        $sql.='on ju.area_id2 = ja3.area_id left join jh_area ja4 on ju.area_id3 = ja4.area_id where jur.role_name<>"超级管理员" and ';
        if($type<0){
            $sql.='1=1';
        }else{
            $sql.='user_type='.$type;
        }
        $res=Db::query($sql);
        foreach ($res as $k=>$v){
            if(empty($v['city'])){
                $res[$k]['city']='全市';
            }if(empty($v['area'])){
                $res[$k]['area']='全区';
            }if(empty($v['street'])){
                $res[$k]['street']='全街道';
            }if(empty($v['group'])){
                $res[$k]['group']='全班组';
            }
        }
        return $res;
    }

    public function test($data)
    {
        echo '<pre/>';
        var_dump($data);
        die('===');
    }


}