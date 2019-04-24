<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"/var/www/html/recycle/public/../app/admin/view/user/role_mana.html";i:1556082505;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<meta http-equiv="X-UA-Compatible" content="no-cache">-->
    <title>角色管理</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/ssbase.css">
    <link rel="stylesheet" href="/static/admin/css/style.css">
    <style>
    
    </style>
</head>
<body>
    <span class="layui-breadcrumb" lay-separator="/" >
        <a href="">人员管理</a>
        <a href="">角色管理</a>
    </span>
    <div class="topLine">
        <div class="flex-box flex-2">
            <div style="margin-top: 15px">角色选择：</div>
            <div>
                <div class="rol_btn">
                <?php foreach($roles as $val): ?>
                <button class="layui-btn layui-btn-primary layui-btn-small maTop_10 roles" data-to="<?php echo $val['role_id']; ?>"><?php echo $val['role_name']; ?></button>
                <?php endforeach; ?>
                </div>
                <button class="layui-btn layui-btn-small new_role maTop_10">新建角色</button>
            </div>
        </div>
        <hr>
        <p style="border: 1px solid #dcdcdc">
            <button class="layui-btn layui-btn-small layui-btn-danger role_chooes"></button>
            <button class="layui-btn layui-btn-small layui-btn-warm role_set">权限设置</button>
            <button class="layui-btn layui-btn-small layui-btn-danger role_del" style="margin-left:300px ">删除该角色</button>
        </p>
        <div class="role_bg">
            <form class="layui-form" id="" action="">
                <?php foreach($auths as $key=>$val): ?>
                <div class="layui-form-item" style="margin-top: 20px;border-top: 1px solid #f6f6f6">
                    <?php foreach($val as $k=>$v): if(!is_array($v)): ?>
                            <label class="layui-form-label">
                                <?php echo $val[$k]; ?>
                            </label>
                        <?php else: ?>
                            <input type="checkbox" class="Jauth" data-to="<?php echo $val[$k]['auth_id']; ?>" title="<?php echo $val[$k]['name']; ?>" lay-skin="primary">
                        <?php endif; endforeach; ?>
                </div>
                <?php endforeach; ?>
            </form>
        </div>
    </div>   
</body>

<script src="/static/common/js/jquery-2.1.4.min.js"></script>
<!-- layui 1.0.9版本 -->
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>

<script src="/static/admin/js/role_mana.js"></script>
</html>