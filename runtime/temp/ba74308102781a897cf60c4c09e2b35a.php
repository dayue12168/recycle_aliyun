<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/var/www/html/recycle/public/../app/admin/view/user/manager_mana.html";i:1556082505;s:56:"/var/www/html/recycle/app/admin/view/common/address.html";i:1556082505;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理员管理</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/ssbase.css">
    <link rel="stylesheet" href="/static/admin/css/style.css">
    <style>

    </style>
</head>
<body>
    <span class="layui-breadcrumb" lay-separator="/" >
        <a href="">人员信息</a>
        <a href="">管理员管理</a>
    </span>
    <div class="topLine">
        <div class="layui-form" action="">
            管理员列表
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
                <input type="checkbox" value="0" title="系统管理员" lay-skin="primary">
                <input type="checkbox" value="1" title="商户管理员" lay-skin="primary">
                <button style="margin-top: 0;margin-left: 20px" class="layui-btn layui-btn-small query_manager">查询管理员</button>
                <button style="margin-top: 0;" class="layui-btn layui-btn-small add_manager">添加管理员</button>
            </div>
            <table class="layui-table">
                <colgroup>
                    <!-- 此处 width 按比例分割 -->
                    <col width="100">
                    <col width="120">
                    <col width="120">
                    <col width="150">
                    <col width="100">
                    <col width="150">
                    <col width="50">
                    <col width="250">
                    <col width='50'>
                </colgroup>
                <thead>
                    <tr>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>人员类别</th>
                    <th>区域</th>
                    <th>角色</th>
                    <th>最后登录时间</th>
                    <th>公众号</th>
                    <th>操作</th>
                    <th>环卫工列表</th>
                    </tr> 
                </thead>
                <tbody class="tbody">
                    <?php foreach($users as $val): ?>
                    <tr>
                        <td style="display: none"><?php echo $val['user_id']; ?></td>
                        <td><?php echo $val['user_name']; ?></td>
                        <td><?php echo $val['tel']; ?></td>
                        <td><?php if($val['user_type'] == 0): ?>系统管理员<?php else: ?>商户管理员<?php endif; ?></td>
                        <td><?php echo $val['city']; ?>-<?php echo $val['area']; ?>-<?php echo $val['street']; ?>-<?php echo $val['group']; ?></td>
                        <td><?php echo $val['role_name']; ?></td>
                        <td><?php echo $val['last_login_time']; ?></td>
                        <td><?php echo $val['wx_band']; ?></td>
                        <td>
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-small reset_manager">修改</button>
                            <button type="button" class="layui-btn layui-btn-danger layui-btn-small">解绑微信</button>
                            <button type="button" class="layui-btn layui-btn-danger layui-btn-small reset_forbid"><?php if($val['state']): ?>启用<?php else: ?>禁用<?php endif; ?></button>
                        </td>
                        <td>
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-small check_huan">环卫工列表</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> 
            <div class="layui-elem-quote" style="padding: 5px 0;">
                &nbsp;&nbsp;查询到管理员总数：<span class="len"></span>
                &nbsp;&nbsp; &nbsp;&nbsp;<div id="demo5" style="display: inline-block;"></div>
            </div>
        </div>
    </div>   
</body>
<!-- 添加管理员 -->
<div id="addManager" style="display: none;">
    <form class="layui-form" id="ManaForm" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">
                姓名
            </label>
            <div class="layui-input-inline">
                <input type="index" name="name" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                手机号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="tel" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                初始密码
            </label>
            <div class="layui-input-inline">
                <input type="index" name="pwd" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                人员类别
            </label>
            <div class="flex-box flex-2">
                <input type="radio" name="type" value="0" title="系统管理员">
                <input type="radio" name="type" value="1" title="商户管理员" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                区域
            </label>
            <div class="flex-box flex-4">
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
                <select name="group_g">
                    <?php foreach($groups as $val): ?>
                    <option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item" >
            <label class="layui-form-label">
                角色
            </label>
            <div>
                <?php foreach($roles as $val): ?>
                <input type="radio" name="role" value="<?php echo $val['role_id']; ?>" title="<?php echo $val['role_name']; ?>" lay-skin="primary">
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>
<!-- 管理员信息修改 -->
<div id="resetManager" style="display: none;">
    <form class="layui-form" id="re_manaForm" action="">
        <input type="index"  class="layui-input" style="display: none" name="Jid">
        <div class="layui-form-item">
            <label class="layui-form-label" >
                姓名
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jname" class="layui-input" required lay-verify="required">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                手机号
            </label>
            <div class="layui-input-inline">
                <input type="index" name="Jtel" class="layui-input" required lay-verify="required">
            </div>
        </div>
       <!-- <div class="layui-form-item">
            <label class="layui-form-label">
                初始密码
            </label>
            <div class="layui-input-inline">
                <input type="index" name="" class="layui-input" required lay-verify="required">
            </div>
        </div>-->
        <div class="layui-form-item">
            <label class="layui-form-label">
                人员类别
            </label>
            <div class="flex-box flex-2">
                <input type="radio" name="JuserType" value="0" title="系统管理员">
                <input type="radio" name="JuserType" value="1" title="商户管理员">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                区域
            </label>
            <div class="flex-box flex-4">
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
                <select name="group_g">
                    <?php foreach($groups as $val): ?>
                    <option value="<?php echo $val['area_id']; ?>"><?php echo $val['area_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item" >
            <label class="layui-form-label">
                角色
            </label>
            <div>
                <?php foreach($roles as $val): ?>
                <input type="radio" name="role" value="<?php echo $val['role_id']; ?>" title="<?php echo $val['role_name']; ?>" lay-skin="primary">
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>
<script src="/static/common/js/jquery-2.1.4.min.js"></script>
<!-- layui 1.0.9版本 -->
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/manager_mana.js"></script>
<script src="/static/admin/js/change_addr.js"></script>
</html>