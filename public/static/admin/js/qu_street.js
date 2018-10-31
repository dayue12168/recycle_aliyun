
  
//   区-街道-班组管理 ---------------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element;  //依赖
  });
  layui.use("layer",function(){
      var layer = layui.layer;
  })
  
  $(".layui-edit").click(function(){
      var name = $(this).siblings().html();
      var that = $(this);
      layer.prompt({
          formType: 0,
          value: name,
          title: "改名",
          }, function(value, index, elem){
              // $.ajax({
              //     url:"",
              //     type:"POST",
              //     data:value,
              //     success:function(){
                      that.siblings().html(value);
                      layer.close(index);
              //     }
              // })
      });
  });
  $(".layui-add1").click(function(){
      var _html = $(".tbody1");
      layer.prompt({
          formType:0,
          value:"街道名",
          title:"新增街道",
          },function(value,index,elem){
          var oTr = '<tr><td><span>'+value+'</span> <i class="layui-icon layui-edit">&#xe642;</i></td><td> <i class="layui-icon layui-add1">&#xe608;</i></td></tr>';
          _html.append(oTr);
          layer.close(index);
      });
  });
  $(".layui-add2").click(function(){
      var _html = $(".tbody2");
      layer.prompt({
          formType:0,
          value:"班组",
          title:"新增班组",
          },function(value,index,elem){
          var oTr = '<tr><td><span>'+value+'</span> <i class="layui-icon layui-edit">&#xe642;</i></td><td> <i class="layui-icon layui-add2">&#xe608;</i></td></tr>';
          _html.append(oTr);
          layer.close(index);
      });
  })