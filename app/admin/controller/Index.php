<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/10/30
 * Time: 9:48
 */

namespace app\admin\controller;
use app\admin\controller\Base;
use think\Session;

class Index extends Base
{
    //首页
    public function index()
    {
        //获取其角色以及对应的权限列表
        $role=model('User','service')->getRole(session('adminUser'));
        session('adminRole',$role['role_name']);
        return $this->fetch();
    }

    public function index2()
    {
        return $this->fetch();
    }

    //区-街道-班组管理
    public function qu_street()
    {
        $citys=model('Address','service')->getCitys();
        $city=$citys[0]['area_id'];
        $regions=model('Address','service')->getChildAddr($city);
        $region=$regions[0]['area_id'];
        $roads=model('Address','service')->getChildAddr($region);
        $road=$roads[0]['area_id'];
        $groups=model('Address','service')->getChildAddr($road);
        $this->assign('citys',$citys);
        $this->assign('regions',$regions);
        $this->assign('roads',$roads);
        $this->assign('groups',$groups);
        return $this->fetch();
    }

    //设备管理
    public function device_mana()
    {
        $citys=model('Address','service')->getCitys();
        $city=$citys[0]['area_id'];
        $regions=model('Address','service')->getChildAddr($city);
        $region=$regions[0]['area_id'];
        $roads=model('Address','service')->getChildAddr($region);
        $this->assign('citys',$citys);
        $this->assign('regions',$regions);
        $this->assign('roads',$roads);
        $caps=model('Index','service')->device_mana();
        $types=model('Index','service')->getTypes();
        $this->assign('types',$types);
        $this->assign('caps',$caps);
        return $this->fetch();
    }

    //垃圾桶管理
    public function trash_mana()
    {
        $citys=model('Address','service')->getCitys();
        $city=$citys[0]['area_id'];
        $regions=model('Address','service')->getChildAddr($city);
        $region=$regions[0]['area_id'];
        $roads=model('Address','service')->getChildAddr($region);
        $road=$roads[0]['area_id'];
        $groups=model('Address','service')->getChildAddr($road);
        $this->assign('citys',$citys);
        $this->assign('regions',$regions);
        $this->assign('roads',$roads);
        $this->assign('groups',$groups);
        return $this->fetch();
    }







}