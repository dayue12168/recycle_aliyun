// 角色管理 -----------------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  // <!-- 分页 -->
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
  
  })
  layui.use("form",function(){
      var form = layui.form();
  
  })
  // <!-- 新建角色 -->
  $(".new_role").click(function(){
      layer.prompt({
          formType: 0,
          value: '角色名',
          title: '新建角色',
          }, function(value, index, elem){
              console.log(value);
              // $.ajax({
              //     url:"",
              //     type:"POST",
              //     data:"",
              //     cache:false,
              //     success:function(res){
                  
  
                  layer.close(index);     
              //     }
              // })
      });
  })