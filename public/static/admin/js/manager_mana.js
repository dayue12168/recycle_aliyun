//  管理员管理 ----------------------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo5'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
      // 添加管理员
      $("button.add_manager").click(function(){
          layer.open({
              type:1,
              title:"添加管理员",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#addManager"), 
              yes:function(index){
                  var data=$("#ManaForm").serialize();
                  $.ajax({
                      url:"/admin/user/addAdmin",
                      type:"POST",
                      data:data,
                      cache:false,
                      success:function(res){
                          // console.log(res);
                          var tbody=$('.tbody');
                          var str='<td style="display: none">'+res.user_id+'</td><td>'+res.user_name+'</td><td>' + res.tel+'</td><td>';
                          str+=res.user_type+'</td><td>'+res.area_id0+'-'+res.area_id1;
                          str+='-'+res.area_id2+'-'+res.area_id3+'</td><td>'+res.role_id+'</td><td>';
                          str+=res.last_login_time+'</td><td>'+res.wx_band+'<td>';
                          str+='<button type="button" class="layui-btn layui-btn-normal layui-btn-small reset_manager">修改</button>';
                          str+='<button type="button" class="layui-btn layui-btn-danger layui-btn-small">解绑微信</button>';
                          str+='<button type="button" class="layui-btn layui-btn-danger layui-btn-small">禁用</button>';
                          str+='</td><td><button type="button" class="layui-btn layui-btn-normal layui-btn-small">环卫工列表</button>';
                          str+='</td></tr>';
                          tbody.append(str);
                          layer.msg('添加管理'+res.user_name+'成功');
                      },
                      error:function(){
                          layer.msg('请检查您的信息是否完整、电话号码'+res.tel+'是否已注册');
                      }
                  })
                  layer.close(index);
              }
          })
      });
      // 修改管理员信息
      $("button.reset_manager").click(function(){
          form.render('select');
          //直接赋值
          var name=$(this).parent().prevAll().eq(7).text();
          $("[name='Jid']").attr('value',name);
          var name=$(this).parent().prevAll().eq(6).text();
          $("[name='Jname']").attr('value',name);
          var name=$(this).parent().prevAll().eq(5).text();
          $("[name='Jtel']").attr('value',name);
          var that=$(this);
          layer.open({
              type:1,
              title:"管理员信息修改",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#resetManager"),
              yes:function(index){
                  var data=$("#re_manaForm").serialize();
                  $.ajax({
                      url:"/admin/user/updateAdmin",
                      type:"POST",
                      data:data,
                      cache:false,
                      success:function(res){
                          // console.log(res);
                          that.parent().prevAll().eq(6).text(res.user_name);
                          that.parent().prevAll().eq(5).text(res.tel);
                          that.parent().prevAll().eq(4).text(res.user_type);
                          that.parent().prevAll().eq(3).text(res.area_id0+'-'+res.area_id1+'-'+res.area_id2+'-'+res.area_id3);
                          that.parent().prevAll().eq(2).text(res.role_id);
                          layer.msg('修改管理'+res.user_name+'成功');
                      },
                      error:function(){
                          layer.msg('请检查您的信息是否完整、电话号码'+res.tel+'是否已注册');
                      }
                  });
                  layer.close(index);
              }
          })
      });

      //禁用/启用管理员
      $("button.reset_forbid").click(function(){
              var temp=$(this).text();
              var forbid="禁用";
              var use='启用';
              var id=$(this).parent().prevAll().last().text();
              var that=$(this);
              if(temp==forbid){
                  temp=use;
                  var state=1;
              }else{
                  temp=forbid;
                  var state=0;
              }
              $.ajax({
                  url:'/admin/user/setToggle',
                  type:'post',
                  data:{'id':id,'state':state},
                  cache:false,
                  success:function(res){
                      console.log(res);
                      that.text(temp);
                  },
                  error:function(){
                      layer.msg('修改失败');
                  }
              });
          });

  });
  var len = $(".tbody>tr").length;     
  $(".len").html(len);