// 设备管理 ------------------------------------------------------------------

  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demoOne'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
  
      // 添加设备
      $(".add_SB").click(function(){
          layer.open({
              type:1,
              title:"添加设备",
              btn:["确定","取消"],
              area:["400px","450px"],
              content:$("#addSB"), 
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
      $(".reSet").click(function(){
          // 类型  编号 IMEI IMSI SIM 位置
          $(".reset_type").find("option[value='0']").remove();
          var oNum = $(".reset_number"),
              oImei = $(".reset_IMEI"),
              oImsi = $(".reset_IMSI"),
              oSim = $(".reset_SIM"),
              oPos = $(".reset_position");
          var _html = [];
          $(this).parent().siblings().each(function(){
              var SBinfo = $(this).html();
              _html.push(SBinfo);        
          })
          var option = "<option value='0' selected>"+_html[3]+"</option>";
          $(".reset_type").prepend(option);
          form.render('select'); 
          // oType.text(_html[3]);
          oNum.val(_html[2]);
          oImei.val(_html[0]);
          oImsi.val(_html[1]);
          oSim.val(_html[4]);
          oPos.val(_html[5]);
          layer.open({
              type:1,
              title:"设备信息修改",
              btn:["确定","取消"],
              area:["400px","450px"],
              content:$("#resetSB"),
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
