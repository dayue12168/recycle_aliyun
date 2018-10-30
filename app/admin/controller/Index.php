<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/10/30
 * Time: 9:48
 */

namespace app\admin\controller;
use app\admin\controller\Base;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function index2()
    {
        return $this->fetch();
    }

    //区-街道-班组管理
    public function qu_street()
    {
        return $this->fetch();
    }

    //设备管理
    public function device_mana()
    {
        return $this->fetch();
    }

    //垃圾桶管理
    public function trash_mana()
    {
        return $this->fetch();
    }
    //角色管理
    public function role_mana()
    {
        return $this->fetch();
    }
    //系统管理员管理
    public function manager_mana()
    {
        return $this->fetch();
    }
    //环卫工管理
    public function sanitation()
    {
        return $this->fetch();
    }
    //短信提醒设置
    public function info_manager()
    {
        return $this->fetch();
    }
    //日志管理
    public function log_manage()
    {
        return $this->fetch();
    }
    //垃圾数量统计表
    public function trash_number()
    {
        return $this->fetch();
    }
    //垃圾溢出情况统计表
    public function trash_overflow()
    {
        return $this->fetch();
    }

    //回收效率统计表
    public function recovery()
    {
        return $this->fetch();
    }
    //环卫工接收消息列表
    public function info_huanwei()
    {
        return $this->fetch();
    }
}