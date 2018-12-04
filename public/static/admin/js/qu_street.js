//   区-街道-班组管理 ---------------------------------------------------------------------------------
layui.use('form', function() {
    var form = layui.form();


  layui.use('element', function(){
    var element = layui.element;  //依赖
  });
  layui.use("layer",function(){
      var layer = layui.layer;
  })


    //选择市---区
    $("button.cityChose").click(function(){
        var id=$(this).val();

        $.ajax({
            url:"/admin/Address/getOneChild",
            type:"POST",
            data:{'id':id},
            cache:false,
            success:function(res){
                var area=$('#Jarea');
                area.nextAll('button').remove();
                var str='';
                for(var i in res){ 
                    str+='<button class="layui-btn layui-btn-primary layui-btn-small maTop_10 areaChose" ' +
                        'value="'+res[i].area_id+'">'+res[i].area_name+'</button>';
                }
                str.substring(1);
                area.html(str);
                choses.quchose();
                choses.streetchose();
            }
        })
    });


  //选择区--路
  var choses = {
    quchose:function(){
        $("button.areaChose").click(function(){
          $(this).removeClass("layui-btn-primary").siblings().not("span").addClass("layui-btn-primary");
          var $id=$(this).val();
          var name=$(this).text();
          $.ajax({
              url:"/admin/Address/getOneChild",
              type:"POST",
              data:{'id':$id},
              cache:false,
              success:function(res){
                  var area=$('tbody.tbody1');
                  area.find('td').remove();
                  var str='<tr>';
                  for(var i in res){
                      str+='<td class="flex-box flex-b" ><a class="str_team" value="'+res[i].area_id+'">'+res[i].area_name+'</a> <i class="layui-icon layui-edit">&#xe642;</i></td>';
                  }
                  str+='</tr>';
                  area.html(str);
                  choses.streetchose();
                  $('#Jregion').attr('value',$id).text(name);
              }
          })
      })
    },
    streetchose:function(){
      $(".str_team").click(function(){
        var name = $(this).html();
        $("#Jroad").html(name); 
      })
    }
  };
  choses.quchose();
  choses.streetchose();





    //改名
  $(".layui-edit").click(function(){
      var name = $(this).siblings().html();
      var id = $(this).prev().attr('value');
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
      var id=$(this).prev().attr('value');
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
      var id=$(this).prev().attr('value');
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






