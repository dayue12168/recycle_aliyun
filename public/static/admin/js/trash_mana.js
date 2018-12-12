
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
                  var data=$('#JaddTrash').serialize();
                  // console.log(data);
                  $.ajax({
                      url:"/admin/index/addTrash",
                      type:"POST",
                      data:data,
                      cache:false,
                      success:function(res){
                            // console.log(res);
                            var tbody=$('tbody.tbody');
                            var list='<tr><td class="bind_id" style="display: none">'+res.dustbinId+'</td><td>'+res.dust_serial
                                +'</td><td><span class="city">'+res.city+'</span>-<span class="area">'+res.area+'</span>-'
                                +'<span class="street">'+res.street+'</span></td><td>'+res.dust_length+'*'+res.dust_width
                                +'*'+res.dust_height+'</td><td>'+res.longitude+','+res.latitude+'</td><td></td>' +
                                '<td><button type="button" class="layui-btn layui-btn-danger layui-btn-small Jbind">绑定</button>' +
                                '</td><td><span>0</span><button type="button" class="layui-btn layui-btn-normal layui-btn-small  trashMana">管理</button></td>' +
                                '<td><button type="button" class="layui-btn layui-btn-normal layui-btn-small reset_trash">修改</button></td></tr>';
                            tbody.append(list);
                            layer.msg('垃圾桶'+res.dust_serial+'添加成功');
                            form.render();
                      }
                  })
                  layer.close(index);
              }
          })
      })
      // 修改
      $(".layui-table").on("click","button.reset_trash",function(){
          var id = $(this).parent("td").siblings(".bind_id").text();
          
          $.ajax({
              url:"/admin/index/getTrash",
              type:"POST",
              data:{"id":id},
              cache:false,
              success:function(res){
                console.log(res);
                
                        layer.open({
                            type:1,
                            title:"设备信息修改",
                            btn:["确定","取消"],
                            area:["400px","450px"],
                            content:$("#resetTrash"),
                            yes:function(index){
                                // $.ajax({
                                //     url:"/admin/index/updateTrash",
                                //     type:"POST",
                                //     data:"",
                                //     cache:false,
                                //     success:function(res){
                
                                //     }
                                // })
                                layer.close(index);
                            }
                        });
              }
          })

      });


      //查询垃圾桶
      $("button.query_trash").click(function(){
          var checked=$("input[type='checkbox']:checked");
          var str='';
          $.each(checked,function(ele,index){
              str+=','+index.value;
          });
          var type=str.substring(1);
          var cityVal = $('select[name="city_g"] option:selected').val();
          var areaVal = $('select[name="area_g"] option:selected').val();
          var streetVal = $('select[name="street_g"] option:selected').val();
          var groupVal = $('select[name="group_g"] option:selected').val();
          var addr=cityVal+','+areaVal+','+streetVal+','+groupVal;
          $.ajax({
              url:"/admin/index/queryTrash",
              type:"post",
              data:{'type':type,'addr':addr},
              cache:false,
              success:function(res){
                  // console.log(res);
                  var tb=$("tbody.tbody");
                  var str='';
                  for(var i in res){
                      if(res[i].cap_id){
                          var td='<button type="button" class="layui-btn layui-btn-danger layui-btn-small Junbind">解绑</button>';
                      }else{
                          var td='<button type="button" class="layui-btn layui-btn-danger layui-btn-small Jbind">绑定</button>';
                      }
                      str +='<tr><td class="bind_id" style="display: none">'+res[i].dustbin_id+'</td> <td>'+res[i].dust_serial
                          +'</td><td><span class="city">'+res[i].city+'</span>-<span class="area">'+res[i].area+'</span>-<span class="street">'
                          +res[i].street+'</span>' +'</td><td>'+res[i].dust_length+'*'+res[i].dust_width+'*'+res[i].dust_height
                          +'</td><td>'+res[i].longitude+','+res[i].latitude+'</td><td>'+res[i].cap_imei+'</td><td>'+td+'</td>' +
                          '<td><span>'+res[i].count+'</span>' +
                          '<button type="button" class="layui-btn layui-btn-normal layui-btn-small  trashMana">管理</button>' +
                          '</td><td><button type="button" class="layui-btn layui-btn-normal layui-btn-small reset_trash">修改</button>' +
                          '</td></tr>';
                  }
                  // console.log(str);
                  tb.html(str);
                  form.render();
              }
          })
      });

      //解绑垃圾桶
      $(".layui-table").on('click','.Junbind',function(){
          var id=$(this).parent().prevAll().eq(5).text();
          var that=$(this);
          layer.open({
              type:1,
              title:"解绑设备",
              btn:["确定","取消"],
              yes:function(index){
                  $.ajax({
                      url:'/admin/index/freeTrash',
                      type:'post',
                      data:{'id':id},
                      cache:false,
                      success:function(){
                          that.removeClass('Junbind').addClass("Jbind").text('绑定');
                          that.parent().prev().text('');
                          layer.msg('解绑成功');
                      },
                      error:function(){
                          layer.msg('修改失败');
                      }
                  })
                  layer.close(index);
              }
          })

      })




  })
  var len = $(".tbody>tr").length;     
  $(".len").html(len);