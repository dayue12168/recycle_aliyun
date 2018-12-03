//   区-街道-班组管理 ---------------------------------------------------------------------------------
layui.use('form', function() {
    var form = layui.form();
    form.on("select(group)",function(data){
        var Id=data.value;
        var name=$(this).text();
        $('#JJgroup').text(name).attr('Jdata',Id);
    });

  layui.use('element', function(){
    var element = layui.element;  //依赖
  });
  layui.use("layer",function(){
      var layer = layui.layer;
  })




    //改名
  $(".layui-edit").click(function(){
      var name = $(this).siblings().html();
      var id = $(this).prev().attr('jdata');
      var that = $(this);
      layer.prompt({
          formType: 0,
          value: name,
          title: "改名",
          }, function(value, index, elem){
              $.ajax({
                  url:"/admin/Address/updateName",
                  type:"POST",
                  data:{'id':id,'name':value},
                  cache:false,
                  success:function(res){
                      layer.msg(res.info);
                      that.siblings().html(value);
                      $('#Jroad').text(value);
                      layer.close(index);
                  }
              })
      });
  });

  //新增街道
  $(".layui-add1").click(function(){
      var _html = $(".tbody1");
      var id=$(this).prev().attr('Jdata');
      layer.prompt({
          formType:0,
          value:"街道名",
          title:"新增街道",
          },function(value,index,elem){
          // console.log(value);
          $.ajax({
              url:"/admin/address/addChild",
              type:"POST",
              data:{'id':id,'name':value},
              success:function(res){
                layer.msg(res.info);
                layer.close(index);
              }
          })
      });
  });

  //新增班组
  $(".layui-add2").click(function(){
      var _html = $(".tbody2");
      var id=$(this).prev().attr('Jdata');
      layer.prompt({
          formType:0,
          value:"班组",
          title:"新增班组",
          },function(value,index,elem){
          $.ajax({
              url:"/admin/address/addChild",
              type:"POST",
              data:{'id':id,'name':value},
              success:function(res){
                  console.log(res);
                  layer.msg(res.info);
                  layer.close(index);
              }
          })
      });
  })
});




