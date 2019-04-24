<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/var/www/html/recycle/public/../app/admin/view/index/trash_huanwei.html";i:1556082505;s:56:"/var/www/html/recycle/app/admin/view/common/address.html";i:1556082505;}*/ ?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>垃圾桶-环卫工绑定</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/ssbase.css">
    <link rel="stylesheet" href="/static/admin/css/style.css">
    <style>
       a:hover{cursor: pointer;color: #1e9fff}

        .bind_info{min-width: 10%;position: fixed;right: 20px;top: 200px;border:1px solid #999;padding: 15px;}
        .bind_info p{margin:10px 0}
        .bind_info .bin{color: #35A9FF}
    </style>
</head>

<body> 
    
    <span class="layui-breadcrumb" lay-separator="/" >
        <a href="#">基本信息</a>
        <a href="#"> 垃圾桶-环卫工绑定</a>
    </span>
    <div class="topLine" >
        <div class="layui-form">

        	<div class="layui-input-block flex-box flex-3" style="margin:10px 0;padding: 0;">
                <select name="city_g" lay-verify="required" lay-filter="address" class="Jchange">
    <?php foreach($citys as $val): ?>
    <option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
    <?php endforeach; ?>
</select>
<select name="area_g" lay-verify="required" lay-filter="address" class="Jchange">
    <?php foreach($regions as $val): ?>
    <option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
    <?php endforeach; ?>
</select>
<select name="street_g" lay-verify="required" lay-filter="address" class="Jchange">
    <?php foreach($roads as $val): ?>
    <option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
    <?php endforeach; ?>
</select>
                <select name="" id="" >
                    <option value="0"></option>
                </select>
            </div>
	        <div class="flex-box flex-2" style="margin-bottom: 100px">
	            <div style="min-width:400px;max-width: 550px;margin: 10px 30px;padding: 0;overflow-y: auto;max-height: 400px;">
	                <table class="layui-table oTable1" style="margin-top: 0">
						<colgroup>
	                        <col width="130">
	                        <col width="130">
	                        <col width="130">
	                    </colgroup>
	                    <thead style="min-width: 400px;max-width: 550px;">
	                        <tr style="min-width: 400px;max-width: 550px;">
	                            <th>垃圾桶编号</th>
	                            <th>设备IMEI号</th>
	                            <th>已绑定数量</th>
	                        </tr>
	                    </thead>
	                    <tbody class="tbody1 ">
	                        <tr>
	                            <td><a  class="trash_num" >123123</a> </td>
	                            <td>123123</td>
	                            <td>1<button type="button" class="layui-btn  layui-btn-radius layui-btn-normal layui-btn-mini trashManager">管理</button></td>
	                        </tr>

	                    </tbody>
	                </table>
	                
	            </div>
	            <div style="min-width:400px;max-width: 550px;margin: 10px 30px;max-height: 400px;overflow-y: auto;">
	                <table class="layui-table oTable2" style="margin-top: 0">
	                    <colgroup>
	                        <!-- 此处 width 按比例分割 -->
	                        <col width="130">
	                        <col width="130">
	                        <col width="130">
	                    </colgroup>
	                    <thead>
	                        <tr style="min-width: 400px;max-width: 550px;">
	                        	<th>环卫工姓名</th>
	                        	<th>已绑定数量</th>
	                        </tr>
	                    </thead>
	                    <tbody class="tbody2">
	                        <tr>
	                            <td><a class="huanwei">BBBB</a></td>
	                            <td>1<button type="button" class="layui-btn  layui-btn-radius layui-btn-normal layui-btn-mini hwManager">管理</button></td>
	                        </tr>
	                    </tbody>
	                </table>
	            </div>
	        </div>
        </div>
    </div>
	
	<div class="bind_info">
		<h2><b>绑定信息确认</b></h2>
		<p>
			已选垃圾：<span class="bin bind1"></span>
		</p>
		<p>
			已选环卫：<span class="bin bind2"></span>
		</p>
		<p class="flex-box flex-c">
			<button type="button" class="layui-btn layui-btn-danger layui-btn-mini Bind" >绑定</button>
		</p>
	</div>


</body>
<script src="/static/common/js/jquery-2.1.4.min.js"></script>

<!-- layui 1.0.9版本 -->
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>

<script src="/static/admin/js/trash_huanwei.js"></script>
<script src="/static/admin/js/change_addr.js"></script>
</html>