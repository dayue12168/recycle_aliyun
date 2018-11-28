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
use think\Request;
use app\admin\model\JhCap;

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


    //修改设备信息
    public function updateDevice(Request $request)
    {
        $where['cap_id']=$request->param('id');
        $param['cap_imsi']=$request->param('imsi');
        $param['cap_imei']=$request->param('imei');
        $param['cap_type']=$request->param('type');
        $param['cap_serial']=$request->param('serial');
        $param['cap_sim']=$request->param('sim');
        $param['cap_position']=$request->param('position');
        $jhCap=new JhCap();
        $jhCap->save($param,$where);
        return json($param);
    }

    //添加设备
    public function addDevice(Request $request)
    {
        $param['cap_imei']=$request->param('imei');
        $param['cap_imsi']=$request->param('imsi');
        $param['cap_position']=$request->param('position');
        $param['cap_serial']=$request->param('serial');
        $param['cap_sim']=$request->param('sim');
        $param['cap_type']=intval($request->param('type'));
//        return json($param);
        $jhCap=new JhCap($param);
        $jhCap->save();
        $param['cap_id']=$jhCap->cap_id;
        return json($param);
    }

    //禁用/启用设备
    public function setToggle(Request $request)
    {
        $where['cap_id']=$request->param('id');
        $data['cap_status']=$request->param('status');
        $jhCap=new JhCap();
        $jhCap->save($data,$where);
        $data['id']=$where['cap_id'];
        return json($data);

    }







}