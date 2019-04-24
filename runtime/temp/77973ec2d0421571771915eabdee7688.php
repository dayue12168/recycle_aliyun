<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/var/www/html/recycle/public/../app/admin/view/index/device_mana.html";i:1556082505;s:56:"/var/www/html/recycle/app/admin/view/common/address.html";i:1556082505;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>设备管理</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/ssbase.css">
    <link rel="stylesheet" href="/static/admin/css/style.css">
    <style>
    </style>
</head>
<body>
    <span class="layui-breadcrumb" lay-separator="/" >
        <a href="">基本信息</a>
        <a href="">设备管理</a>
    </span>
    <div class="topLine">
        <div class="layui-form" action="">
            <div class="layui-input-block flex-box flex-b" style="margin: 0;padding: 0;">

                <div class="set_sb">
                    <input type="radio" lay-filter='sb' name="sb" value="0" title="已绑定设备" lay-skin="primary" checked>
                    <input type="radio" lay-filter='sb' name="sb" value="2" title="未绑定设备" lay-skin="primary">
                    <input type="radio" lay-filter='sb' name="sb" value="1" title="已禁用设备" lay-skin="primary">
                </div>
                <div class="flex-box flex-2 flex-col-c">
                    <select name="" id="" lay-verify="required" >
                        <option value="">选择设备类型</option>
                        <?php foreach($types as $key=>$val): ?>
                        <option value="<?php echo $val['cap_type']; ?>" <?php if(!$key): ?>selected<?php endif; ?>><?php echo $val['cap_type']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!--<button style="margin-top: 0;margin-left: 20px;display: none" class="layui-btn layui-btn-small query_SB">查询设备</button>-->
                    <button style="margin-top: 0;margin-left: 20px;" class="layui-btn layui-btn-small query_SB">查询设备</button>

                </div>
            </div>
            <div class="layui-input-block flex-box flex-3 flex-col-c" style="margin:10px 0;padding: 0;">
            <!--<div style="margin:10px 0;padding: 0;">-->
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
                <button style="margin-top: 0;" class="layui-btn layui-btn-small add_SB">添加设备</button>
            </div>
            <table class="layui-table">
                <colgroup>
                    <!-- 此处 width 按比例分割 -->
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="100">
                    <col width="200">
                    <col width="200">
                </colgroup>
                <thead>
                    <tr>
                    <th>设备IMEI号</th>
                    <th>设备IMSI号</th>
                    <th>设备编号</th>
                    <th>设备类型</th>
                    <th>SIM卡编号</th>
                    <th>位置</th>
                    <th>已绑定垃圾桶所属区域</th>
                    <th>操作</th>

                    </tr> 
                </thead>
                <tbody class="tbody">
                    <?php foreach($caps as $val): ?>
                    <tr>
                        <td><?php echo $val['cap_imei']; ?></td>
                        <td><?php echo $val['cap_imsi']; ?></td>
                        <td><?php echo $val['cap_serial']; ?></td>
                        <td><?php echo $val['cap_type']; ?></td>
                        <td><?php echo $val['cap_sim']; ?></td>
                        <td><?php echo $val['cap_position']; ?></td>
                        <td><?php echo $val['address']; ?></td>
                        <td>
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-small reSet">修改</button>
                            <?php if($val['cap_status'] == 0): ?>
                            <button type="button" class="layui-btn layui-btn-danger layui-btn-small Jjiebang">解除绑定</button>
                            <?php else: ?>
                            <button type="button" class="layui-btn layui-btn-danger layui-btn-small Jforbid"><?php if($val['cap_status'] == 1): ?>启用<?php else: ?>禁用<?php endif; ?></button>
                            <?php endif; ?>
                        </td>
                        <td style="display: none"><?php echo $val['cap_id']; ?></td>
                    </tr>
                   <?php endforeach; ?>
                </tbody>
            </table> 
            <div class="layui-elem-quote" style="padding: 5px 0;">
                &nbsp;&nbsp;查询到设备总数：<span class="len"></span>
                &nbsp;&nbsp; &nbsp;&nbsp;<div id="demoOne" style="display: inline-block;"></div>
            </div>
        </div>
    </div>   
</body>
<!-- 添加设备 -->
<div id="addSB" style="display: none;">
    <form class="layui-form" id="addForm" action=""> 
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备类型
            </label>
            <div class="layui-input-inline">
                <select name="type" lay-verify="required" >
                    <option value="">选择设备类型</option>
                    <?php foreach($types as $val): ?>
                    <option value="<?php echo $val['cap_type']; ?>"><?php echo $val['cap_type']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="serial" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备IMEI号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="imei" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备IMSI号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="imsi" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                SIM卡编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="sim" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                位置
            </label>
            <div class="layui-input-inline">
                <input type="index" name="position" class="layui-input" required lay-verify="required">
            </div>
        </div>
    </form>
</div>
<!-- 设备信息修改 -->
<div id="resetSB" style="display: none;">
    <form class="layui-form" id="resetForm" action="">
        <input type="text" class="Jid" name='id' value="" style="display: none">
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备类型
            </label>
            <div class="layui-input-inline">
                <select name="type" class="reset_type">
                    <option value="0">选择设备类型</option>
                    <?php foreach($types as $val): ?>
                    <option value="<?php echo $val['cap_type']; ?>"><?php echo $val['cap_type']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="serial" class="layui-input reset_number" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备IMEI号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="imei" class="layui-input reset_IMEI" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备IMSI号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="imsi" class="layui-input reset_IMSI" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                SIM卡编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="sim" class="layui-input reset_SIM" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                位置
            </label>
            <div class="layui-input-inline">
                <input type="index" name="position" class="layui-input reset_position" required lay-verify="required">
            </div>
        </div>
    </form>
</div>
<script src="/static/common/js/jquery-2.1.4.min.js"></script>
<!-- layui 1.0.9版本 -->
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/js/device_mana.js"></script>
<script src="/static/admin/js/change_addr.js"></script>
</html>