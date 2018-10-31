
//   垃圾桶管理-------------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  // <!-- 分页 -->
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo9'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
  
      // 添加垃圾桶
      $(".add_trash").click(function(){
          layer.open({
              type:1,
              title:"添加垃圾桶",
              btn:["确定","取消"],
              area:["500px","480px"],
              content:$("#addTrash"), 
              yes:function(index){
                  $.ajax({
                      url:"",
                      type:"POST",
                      data:"",
                      cache:false,
                      success:function(res){
  
                      }
                  })
  
                  layer.close(index);
              }
          })
      })
      // 修改
      $(".reset_trash").click(function(){
  
          // 向后台发送垃圾桶编号获取信息，渲染
          $.ajax({
              url:"",
              type:"POST",
              data:"",
              cache:false,
              success:function(res){
  
                  // 渲染表单
                  // layui刷新表单
                  form.render(); 
              }
          })
          
  
          layer.open({
              type:1,
              title:"设备信息修改",
              btn:["确定","取消"],
              area:["400px","450px"],
              content:$("#resetTrash"),
              yes:function(index){
                  $.ajax({
                      url:"",
                      type:"POST",
                      data:"",
                      cache:false,
                      success:function(res){
  
                      }
                  })
                  layer.close(index);
              }
          })
      })
  })
  var len = $(".tbody>tr").length;     
  $(".len").html(len);