//   区-街道-班组管理 ---------------------------------------------------------------------------------
layui.use(['form','element','layer'], function(){
    var form    = layui.form(),
        layer   = layui.layer,
        element = layui.element;
 
    //选择市---区
    $("button.cityChose").eq(0).removeClass("layui-btn-primary");
    $(".areaCho>button").eq(0).removeClass("layui-btn-primary");
    $("button.cityChose").click(function(){
        var id=$(this).val();
        $(this).removeClass("layui-btn-primary").siblings("button").addClass("layui-btn-primary");
        $.ajax({
            url:"/admin/Address/getOneChild",
            type:"POST",
            data:{'id':id},
            cache:false,
            success:function(res){
                var area=$('#Jarea');
                // area.nextAll('button').remove();
                // $(".areaCho").html("");
                var str='';
                for(var i in res){ 
                    str+='<button class="layui-btn layui-btn-primary layui-btn-small maTop_10 areaChose" ' +
                        'value="'+res[i].area_id+'">'+res[i].area_name+'</button>';
                }
                // area.html(str);
                $(".areaCho").html(str);
                $(".areaCho>button").eq(0).removeClass("layui-btn-primary");

                choses.quchose();
                choses.streetchose();

            }
        })
    });

// 选区 ajax封装
function quchoseAjax(_id,_name){
  $.ajax({
      url:"/admin/Address/getOneChild",
      type:"POST",
      data:{'id':_id},
      cache:false,
      success:function(res){
          var area=$('tbody.tbody1');
          // area.find('td').remove();
          var str='<tr>';
          for(var i in res){
              str+='<td class="flex-box flex-b" ><a class="str_team" value="'+res[i].area_id+'">'+res[i].area_name+'</a> <span><i class="layui-icon layui-icon-delete">&#xe640;</i><i class="layui-icon layui-edit">&#xe642;</i></span></td>';
          }
          str+='</tr>';
          area.html(str);
          // 街道选择
          choses.streetchose();
          
          $('#Jregion').attr('value',_id).text(_name);
      }
  })
};
// 选街道 Ajax封装
function streetAjax(_id){
  $.ajax({
      url:"/admin/Address/getOneChild",
      type:"POST",
      data:{'id':_id},
      cache:false,
      success:function(res){
          var area=$('tbody.tbody2');
          area.find('td').remove();
          var str='<tr>';
          for(var i in res){
              str+='<td class="flex-box flex-b" ><a class="str_team" value="'+res[i].area_id+'">'+res[i].area_name+'</a> <span><i class="layui-icon layui-icon-delete">&#xe640;</i><i class="layui-icon layui-edit">&#xe642;</i></span></td> ';
          }
          str+='</tr>';
          area.html(str);
          
      }
  })
}
  var choses = {
    // 区县选择
    quchose:function(){
      // 自动加载第一个
      var _id = $(".areaCho>button").eq(0).val();
      var _name=$(".areaCho>button").text();
      quchoseAjax(_id,_name);
      // 选区加载
      $("button.areaChose").click(function(){
        $(this).removeClass("layui-btn-primary").siblings().not("span").addClass("layui-btn-primary");
          var id=$(this).val();
          var name=$(this).text();
          quchoseAjax(id,name);
      })
    },
    // 街道选择
    streetchose:function(){
      // 自动加载第一个
      var _name = $(".tbody1 .str_team").html();
      var _id=$(".tbody1 .str_team").attr('value');
      $("#Jroad").html(_name).attr('value',_id);
      streetAjax(_id);
      // 选择街道加载 
      $(".str_team").click(function(){
        var name = $(this).html();
        var id=$(this).attr('value');
        $("#Jroad").html(name).attr('value',id);
        streetAjax(id);
      })
    }
  };
  choses.quchose();
  choses.streetchose();
  
// 删除 
      $(".tbody1,.tbody2").on("click",".layui-icon-delete",function(){
        var name = $(this).parent().siblings().html();
        var id = $(this).parent().siblings().attr('value');
        var that = $(this);
        layer.alert('确定删除'+name+'？',{icon:2}, function(index){
          that.parents("td").remove();
          layer.msg("删除成功！",{time:1000});          
          layer.close(index);
        });
      });
// 改名 
      $(".tbody1,.tbody2").on("click",".layui-edit",function(){
        var name = $(this).parent().siblings().html();
        var id = $(this).parent().siblings().attr('value');
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
                  that.parent().siblings().html(value);
                  // $('#Jroad').text(value);
                  layer.close(index);
              }
            })
        });
      });
// 新增街道
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
                //console.log(res);   //state  0 为失败    否则 都是成功  
                if(res.state != 0){
                  _html.append('<tr><td class="flex-box flex-b" Jdata=""><a value="'+res.state+'">'+value+'</a><span><i class="layui-icon layui-icon-delete">&#xe640;</i><i class="layui-icon layui-edit">&#xe642;</i></span></td></tr>');
                }
                layer.msg(res.info);
                layer.close(index);

                // choses.setname();
              }
          })
      });
    });

// 新增班组
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
                  //console.log(res);   //state  0 为失败    否则 都是成功  
                  if(res.state != 0){
                    _html.append('<tr><td class="flex-box flex-b" Jdata=""><a value="'+res.state+'">'+value+'</a><span><i class="layui-icon layui-icon-delete">&#xe640;</i><i class="layui-icon layui-edit">&#xe642;</i></span></td></tr>');
                  }
                  layer.msg(res.info);
                  layer.close(index);

                }
            })
        });
      })
});






