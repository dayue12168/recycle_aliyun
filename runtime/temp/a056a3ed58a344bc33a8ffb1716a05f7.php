<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/var/www/html/recycle/public/../app/admin/view/index/trash_mana.html";i:1556082505;s:56:"/var/www/html/recycle/app/admin/view/common/address.html";i:1556082505;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>垃圾桶管理</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/ssbase.css">
    <link rel="stylesheet" href="/static/admin/css/style.css">

</head>
<body>
    <span class="layui-breadcrumb" lay-separator="/" >
        <a href="">基本信息</a>
        <a href="">垃圾桶管理</a>
    </span>
    <div class="topLine">
        <div class="layui-form" action="">
            <div class="layui-input-block flex-box flex-b" style="margin: 0;padding: 0;">
                <div>
                    <input type="checkbox" name="sb" value="1" title="已绑定设备" lay-skin="primary">
                    <input type="checkbox" name="sb" value="2" title="未绑定设备" lay-skin="primary"><br/>
                    <input type="checkbox" name="sb" value="3" title="已绑定环卫工" lay-skin="primary">
                    <input type="checkbox" name="sb" value="4" title="未绑定环卫工" lay-skin="primary">
                </div>
                <div style='margin-left: 330px' class="flex-box flex-2 flex-col-c">
                    <button style="margin-top: 0;margin-left: 20px" class="layui-btn layui-btn-small query_trash">查询垃圾桶列表</button>
                    <button style="margin-top: 0;" class="layui-btn layui-btn-small add_trash">添加垃圾桶</button>
                </div>
            </div>
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
                <select name="group_g" lay-verify="required" lay-filter="address" class="Jchange">
                    <?php foreach($groups as $val): ?>
                    <option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <table class="layui-table">
                <colgroup>
                    <!-- 此处 width 按比例分割 -->
                    <col width="50">
                    <col width="150">
                    <col width="50">
                    <col width="50">
                    <col width="100">
                    <col width="150">
                    <col width="100">
                    <col width="100">
                </colgroup>
                <thead>
                    <tr>
                    <th>垃圾桶编号</th>
                    <th>对应区域</th>
                    <th>长宽高</th>
                    <th>经纬度</th>
                    <th>绑定设备</th>
                    <th>设备操作</th>
                    <th>已绑定环卫工数量</th>
                    <th>垃圾桶管理</th>

                    </tr> 
                </thead>
                <tbody class="tbody">
                <?php foreach($info as $val): ?>
                    <tr>
                        <td class="bind_id" style="display: none"><?php echo $val['dustbin_id']; ?></td>
                        <td><?php echo $val['dust_serial']; ?></td>
                        <td>
                            <span class='city'><?php echo $val['city']; ?></span>-
                            <span class='area'><?php echo $val['area']; ?></span>-
                            <span class="street"><?php echo $val['street']; ?></span>
                        </td>
                        <td><?php echo $val['dust_length']; ?>*<?php echo $val['dust_width']; ?>*<?php echo $val['dust_height']; ?></td>
                        <td><?php echo $val['longitude']; ?>,<?php echo $val['latitude']; ?></td>
                        <td><?php echo $val['cap_imei']; ?></td>
                        <td><?php if($val['cap_id']): ?>
                            <button type="button" class="layui-btn layui-btn-danger layui-btn-small Junbind">解绑</button>
                            <?php else: ?>
                            <button type="button" class="layui-btn layui-btn-danger layui-btn-small Jbind">绑定</button>
                            <?php endif; ?>
                        </td>
                        <td >
                            <span><?php echo $val['count']; ?></span>
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-small  trashMana">管理</button>
                        </td>
                        <td>
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-small reset_trash">修改</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table> 
            <div class="layui-elem-quote" style="padding: 5px 0;">
                &nbsp;&nbsp;查询到设备总数：<span class="len"></span>
                &nbsp;&nbsp; &nbsp;&nbsp;<div id="demo9" style="display: inline-block;"></div>
            </div>
        </div>
    </div>   
</body>
<!-- 绑定 -->
<div id="G_bind_sb" style="display: none;padding: 10px" >
    <p class="flex-box flex-col-c">
        设备IMEI号： <input type="text" name="sb_IMEI"><input type="button" class="layui-btn layui-btn-mini" id="JqueryDevice" value="查找">
    </p>
    <input type="hidden" value="" name="hide_inp">
    <input type="hidden" value="" name="hide_trash">
    <table class="layui-table">
        <colgroup>
            <col>
        </colgroup>
        <thead>
            <tr>
                <th>设备IMEI号</th>
                <th>设备IMSI号</th>
                <th>设备编号</th>
                <th>设备类型</th>
                <th>SIM卡编号</th>
                <th>位置</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody class="Jcap">
        <?php foreach($device as $val): ?>
            <tr>
                <td style="display:none;"><?php echo $val['cap_id']; ?></td>
                <td><?php echo $val['cap_imei']; ?></td>
                <td><?php echo $val['cap_imsi']; ?></td>
                <td><?php echo $val['cap_serial']; ?></td>
                <td><?php echo $val['cap_type']; ?></td>
                <td><?php echo $val['cap_sim']; ?></td>
                <td><?php echo $val['cap_position']; ?></td>
                <td>
                    <button type="button" class=" layui-btn layui-btn-danger layui-btn-mini bind_sb">绑定</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- 添加设备 -->
<div id="addTrash" style="display: none;">
    <form class="layui-form" id="JaddTrash" action="">
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                区域
            </label>
            <div class=" flex-box flex-b">
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
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                垃圾桶编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jserial" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                地址
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jaddress" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                经度
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jlongitude" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                维度
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jlatitude" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                高德坐标
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jgps_gd" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                长
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jlength" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                宽
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jwidth" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                高
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jheight" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备安装高度
            </label>
            <div class="layui-input-inline">
                <input type="index" name="install_height" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                联通编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="union_serial" class="layui-input" required lay-verify="required">
            </div>
        </div>
    </form>
</div>
<!-- 设备信息修改 -->
<div id="resetTrash" style="display: none;">
    <form class="layui-form" id="JresetTrash" action="">
        <input type="index" name="id" style="display: none" value="">
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                区域
            </label>
            <div class=" flex-box flex-b">
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
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                垃圾桶编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jserial" class="layui-input Jserial2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                地址
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jaddress" class="layui-input Jaddress2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                经度
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jlongitude" class="layui-input Jlongitude2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                维度
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jlatitude" class="layui-input Jlatitude2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                高德坐标
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jgps_gd" class="layui-input Jgps_gd2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                长
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jlength" class="layui-input Jlength2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                宽
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jwidth" class="layui-input Jwidth2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                高
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jheight" class="layui-input Jheight2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                设备安装高度
            </label>
            <div class="layui-input-inline">
                <input type="index" name="install_height" class="layui-input install_height2" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">
                联通编号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="union_serial" class="layui-input union_serial2" required lay-verify="required">
            </div>
        </div>
    </form>
</div>
<script src="/static/common/js/jquery-2.1.4.min.js"></script>
<!-- layui 1.0.9版本 -->
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>

<script src="/static/admin/js/trash_mana.js"></script>
<script src="/static/admin/js/change_addr.js"></script>
</html>