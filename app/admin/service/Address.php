<?php
/**
 * Created by PhpStorm.
 * User: 安远
 * Date: 2018/11/9
 * Time: 14:24
 */
namespace app\admin\service;

use think\Db;

class Address
{
    //获取城市列表
    public function getCitys()
    {
        $sql='select area_id,area_parent_id,area_name from jh_area where area_parent_id=0';
        $res=Db::query($sql);
        return $res;
    }

    //获取某一区域下面的子地区列表
    public function getChildAddr($addr)
    {
        $sql='select area_id,area_level,area_parent_id,area_name from jh_area where area_parent_id='.$addr;
        $res=Db::query($sql);
        return $res;
    }

    public function addChild($id,$name)
    {
        $level=Db::table('jh_area')->where('area_id',$id)->fetchSql(false)->value('area_level');
        $res=0;
        if($level) {
            $res = Db::table('jh_area')->fetchSql(false)->insert([
                'area_level' => $level+1,
                'area_parent_id' => $id,
                'area_name' => $name
            ]);
        }
        return $res;
    }

    public function updateName($id,$name)
    {
        $res=Db::table('jh_area')->where('area_id',$id)->update(
            ['area_name'=>$name]
        );
        return $res;
    }


}