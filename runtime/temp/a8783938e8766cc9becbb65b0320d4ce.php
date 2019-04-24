<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/var/www/html/recycle/public/../app/admin/view/index/qu_street.html";i:1556082505;}*/ ?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>区-街道-班组管理</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/ssbase.css">
    <link rel="stylesheet" href="/static/admin/css/style.css">
    <style>
       a:hover{cursor: pointer;color: #1e9fff}
       .Top_0{position: fixed;top: 0;z-index: 100}
        .totop{position: fixed;right: 30px;bottom: 40px;background: #1e9fff;color: #fff;padding: 10px 15px;display: none}
        .totop:hover{color: #fff}
    </style>
</head>
<body> 
    
    <span class="layui-breadcrumb" lay-separator="/" >
        <a href="">基本信息</a>
        <a href=""> 区-街道-班组管理</a>
    </span>
    <div class="topLine">
        <div class="layui-form">
         <p><span>城市选择：</span>
             <?php foreach($citys as $val): ?>
             <button class="layui-btn layui-btn-primary layui-btn-small cityChose" value="<?php echo $val['area_id']; ?>" ><?php echo $val['area_name']; ?></button>
             <?php endforeach; ?>
         </p>
        <p class="flex-box flex-col-c"><span id="Jarea">区县选择：</span>
            <span class="areaCho">
            <?php foreach($regions as $val): ?>
            <button class="layui-btn layui-btn-primary layui-btn-small maTop_10 areaChose" value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></button>
            <?php endforeach; ?>
            </span>
        </p> 
        <div class="flex-box flex-2" style="margin-bottom: 100px">
            <div style="min-width:400px;max-width: 550px;margin: 10px 30px;padding: 0">
                <table class="layui-table oTable1" >
                    <colgroup>
                        <col width="200">
                    </colgroup>
                    <thead style="">
                        <tr style="min-width: 400px;max-width: 550px;">
                            <th class="flex-box flex-b flex-col-c " >
                                <span id="Jregion" value="">请选择地区</span>
                                <button class="layui-btn layui-btn-small layui-btn-normal layui-add1">新增街道</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tbody1 ">
                        <tr>
                            <?php foreach($roads as $val): ?>
                            <td class="flex-box flex-b" ><a  class="str_team"  value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></a> <span><i class="layui-icon layui-icon-delete">&#xe640;</i><i class="layui-icon layui-edit">&#xe642;</i></span></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div style="min-width:400px;max-width: 550px;margin: 10px 30px">
                <table class="layui-table oTable2" style="">
                    <colgroup>
                        <!-- 此处 width 按比例分割 -->
                        <col width="200">
                    </colgroup>
                    <thead>
                        <tr style="min-width: 400px;max-width: 550px;">
                        <th class="flex-box flex-b flex-col-c">
                            <span id="Jroad" value="">请选择街道</span>
                            <button class="layui-btn layui-btn-small layui-btn-normal layui-add2">新增班组</button>
                        </th>
                        </tr>
                    </thead>
                    <tbody class="tbody2">
                        <tr>
                            <?php foreach($groups as $val): ?>
                            <td class="flex-box flex-b" Jdata=""><span value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></span> <span><i class="layui-icon layui-icon-delete">&#xe640;</i><i class="layui-icon layui-edit">&#xe642;</i></span> </td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </div>
        </div>
    </div>
    <!-- 置顶 -->

    <a href="#" class="totop">置顶</a>
    <!-- 置顶end -->
</body>
<script src="/static/common/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>

<script src="/static/admin/js/qu_street.js"></script>
</html>