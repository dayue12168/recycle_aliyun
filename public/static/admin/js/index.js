// <!-- 折线图 -->
var domLine1 = document.getElementById("point_line_1");
var myChart1 = echarts.init(domLine1);
var optionline1 = {
    title: {
        text: '折线图堆叠'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['班组1','班组2','班组3','班组4','班组5'],
        left:"50%",
        top:5
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'班组1',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'班组2',
            type:'line',
            stack: '总量',
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'班组3',
            type:'line',
            stack: '总量',
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'班组4',
            type:'line',
            stack: '总量',
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'班组5',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};

if (optionline1 && typeof optionline1 === "object") {
    myChart1.setOption(optionline1, true);
}

// 登陆
        /**
         * 对layui进行全局配置
         */
        layui.config({
            base: 'js/'
        });

        layui.use('form', function() {
            //监听提交
            layui.form().on('submit(signin)', function(data){
                layer.msg(JSON.stringify(data.field));
                //这里可以发起ajax请求进行登录验证
                return false;
            });

            //修正登录框margin
            var fieldset = layui.jquery("fieldset").eq(0);
            fieldset.css("margin-top", (layui.jquery(window).height() - fieldset.height()) * 0.4 + "px");

            $(document).on("click",".xgmima",function(){
                
                var modify = layer.open({
                    type: 1,
                    title:'修改密码',
                    area: ['400px', '320px'], //宽高
                    content: $('#addmain')
                });
                $(document).on("click",".oSure",function(){
                    
                    if(tels() && passw() && printyzm()){
                        $.ajax({
                            url:'',
                            type:"POST",
                            success:function(data){
                                if(data == 1){
                                    layer.close(modify);
                                    window.location.reload();
                                }
                            }
                        })
                    }
                });
                $(document).on("click",".oCancel",function(){
                    layer.close(modify);
                });

            })
        });

        // 手机号
        var mobile = /^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/;

        tels = function (obj){
        var tel = $("input[name='telphone']").val();
        if(!mobile.test(tel)){
            layer.msg("手机号输入有误")
        return false;
        }else{
        return true;
        }
        }

        // 密码验证
      var pswreg = /^(?:\d+|[a-zA-Z]+|[!@#$%^&*]+).{7,16}$/ ;
      passw = function(){
        var mima = $("input[name='psw1']");
        var psw1 = mima.val();
        if(!pswreg.test(psw1)){
          layer.msg("密码为8-16位的字母、数字和符号");
          mima.val("");
          return false;
        }else{
          return true;
        }
      }


    //验证码倒计时
    var count = 60;

      $("input[name='yzm']").on("click",function(){
        $(this).prop("disabled",true).val("剩余时间"+count+"s");

      clearInterval(timer);
      var that = $(this);
      var timer = setInterval(function(){
        // console.log(count);
        if(count == 0){
          clearInterval(timer);
          that.prop("disabled",false).val("重新发送");
          count = 60;
        }else{
          count--;
          that.prop("disabled",true).val("剩余时间"+count+"s");
        }
     },1000)

      });

            // 验证码
    printyzm = function(){
        var yzm = $("input[name='yzm']").val();
          var url = URL+yzm;
        $.ajax({
          url:url,
          async:false,
          success:function(res){
                 // 验证码输入不符：
            if(res == 0){
            layer.msg("验证码输入有误");
            return false;          
          }else{
            
            return true;
            }
          }
        })
      }
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


// 环卫工接收消息列表------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demoTwo'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
  
  })
  // <!-- 发送时间 -->
  layui.use('laydate', function(){
      var laydate = layui.laydate;
      laydate.render({
          elem:"input[name='startTime']",
      })
      laydate.render({
          elem:"input[name='endTime']",
      })
  });
  var len = $(".tbody>tr").length;     
  $(".len").html(len);


//    消息管理------------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo3'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
      // 添加设备
      $(".add_manager").click(function(){
          layer.open({
              type:1,
              title:"添加管理员",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#addManager"), 
              yes:function(index){
                  // $.ajax({
                  //     url:"",
                  //     type:"POST",
                  //     data:"",
                  //     cache:false,
                  //     success:function(res){
  
                  //     }
                  // })
  
                  layer.close(index);
              }
          })
      })
      // 修改
      $(".reset_manager").click(function(){
          form.render('select'); 
  
          layer.open({
              type:1,
              title:"管理员信息修改",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#resetManager"),
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

//   日志管理--------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo4'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
  
  })
  // <!-- 发送时间 -->
  layui.use('laydate', function(){
      var laydate = layui.laydate;
      laydate.render({
          elem:"input[name='startTime']",
      })
      laydate.render({
          elem:"input[name='endTime']",
      })
  });
  var len = $(".tbody>tr").length;     
  $(".len").html(len);

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
      // 添加设备
      $(".add_manager").click(function(){
          layer.open({
              type:1,
              title:"添加管理员",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#addManager"), 
              yes:function(index){
                  // $.ajax({
                  //     url:"",
                  //     type:"POST",
                  //     data:"",
                  //     cache:false,
                  //     success:function(res){
  
                  //     }
                  // })
  
                  layer.close(index);
              }
          })
      })
      // 修改
      $(".reset_manager").click(function(){
          form.render('select'); 
  
          layer.open({
              type:1,
              title:"管理员信息修改",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#resetManager"),
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

//   回收效率统计表 -----------------------------------------------------------------------------
$(".area_detail>button").click(function(){
    $(this).addClass("layui-btn-normal").removeClass("layui-btn-primary").siblings("button").removeClass("layui-btn-normal").addClass("layui-btn-primary");
    var index = $(this).index();
    $(".area_time>div").eq(index).show().siblings().hide();
})
layui.use('element', function(){
  var element = layui.element();  //依赖
});
layui.use(["layer",'laypage'],function(){
    var layer = layui.layer,
        laypage = layui.laypage;
        laypage({
            cont: 'demo6'
            ,pages: 100 //总页数
            ,groups: 5 //连续显示分页数
        });
        laypage({
            cont: 'demo7'
            ,pages: 100 //总页数
            ,groups: 5 //连续显示分页数
        });
})
layui.use("form",function(){
    var form = layui.form();
    
    form.render('checkbox');
})
// <!-- 发送日期 -->
layui.use('laydate', function(){
    var laydate = layui.laydate;
    laydate.render({
        elem:"input[name='startTime']",

    });
    laydate.render({
        elem:"input[name='endTime']",
     
    });
    laydate.render({
        elem:"input[name='startDate']"
    })
    laydate.render({
        elem:"input[name='endDate']"
    })
    // <!-- 时间范围 -->
    laydate.render({
        elem:"input[name='time_date_start']",
        type:"time"
    });
    laydate.render({
        elem:"input[name='time_date_end']",
        type:"time"
    });
});

// <!-- 总数量 -->
var len = $(".tbody>tr").length;     
$(".len").html(len);


// <!-- 城市 区县。。。navbar -->
$(".nav>.navbar").click(function(){
    $(this).addClass("active").siblings().removeClass("active");
    var index = $(this).index();
    $(".navChild>p").eq(index).removeClass("hide").siblings().addClass("hide");

})
// <!-- 选择省市区街道班组 的全部  触发 -->
function oClick(obj){
    obj.css({"background":"#1AA194","color":"#fff"}).siblings().prop("disabled",true);
}


// <!-- tabnav切换 -->
$(".tabnav>span").click(function(){
    $(this).addClass("tab_active").siblings().removeClass("tab_active");
    var index = $(this).index();
    $(".tab_child>div").eq(index).removeClass("hide").siblings().addClass("hide");
})

// // <!-- 折线图 -->
// var domLine1 = document.getElementById("point_line_1");
// var myChart1 = echarts.init(domLine1);
// var optionline1 = {
//     title: {
//         text: '折线图堆叠'
//     },
//     tooltip: {
//         trigger: 'axis'
//     },
//     legend: {
//         data:['班组1','班组2','班组3','班组4','班组5'],
//         left:"50%",
//         top:5
//     },
//     grid: {
//         left: '3%',
//         right: '4%',
//         bottom: '3%',
//         containLabel: true
//     },
//     toolbox: {
//         feature: {
//             saveAsImage: {}
//         }
//     },
//     xAxis: {
//         type: 'category',
//         boundaryGap: false,
//         data: ['周一','周二','周三','周四','周五','周六','周日']
//     },
//     yAxis: {
//         type: 'value'
//     },
//     series: [
//         {
//             name:'班组1',
//             type:'line',
//             stack: '总量',
//             data:[120, 132, 101, 134, 90, 230, 210]
//         },
//         {
//             name:'班组2',
//             type:'line',
//             stack: '总量',
//             data:[220, 182, 191, 234, 290, 330, 310]
//         },
//         {
//             name:'班组3',
//             type:'line',
//             stack: '总量',
//             data:[150, 232, 201, 154, 190, 330, 410]
//         },
//         {
//             name:'班组4',
//             type:'line',
//             stack: '总量',
//             data:[320, 332, 301, 334, 390, 330, 320]
//         },
//         {
//             name:'班组5',
//             type:'line',
//             stack: '总量',
//             data:[820, 932, 901, 934, 1290, 1330, 1320]
//         }
//     ]
// };
//
// if (optionline1 && typeof optionline1 === "object") {
//     myChart1.setOption(optionline1, true);
// }
// 折线图2
var domLine2 = document.getElementById("point_line_2");
var myChart2 = echarts.init(domLine2);
var optionline2 = {
    title: {
        text: '折线图堆叠'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:['班组1','班组2','班组3','班组4','班组5'],
        left:"50%",
        top:5
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一','周二','周三','周四','周五','周六','周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'班组1',
            type:'line',
            stack: '总量',
            data:[120, 132, 101, 134, 90, 230, 210]
        },
        {
            name:'班组2',
            type:'line',
            stack: '总量',
            data:[220, 182, 191, 234, 290, 330, 310]
        },
        {
            name:'班组3',
            type:'line',
            stack: '总量',
            data:[150, 232, 201, 154, 190, 330, 410]
        },
        {
            name:'班组4',
            type:'line',
            stack: '总量',
            data:[320, 332, 301, 334, 390, 330, 320]
        },
        {
            name:'班组5',
            type:'line',
            stack: '总量',
            data:[820, 932, 901, 934, 1290, 1330, 1320]
        }
    ]
};

if (optionline2 && typeof optionline2 === "object") {
    myChart2.setOption(optionline2, true);
}

// <!-- 饼图 -->
var domBing1 = document.getElementById("bing_1");
var myChart_b1 = echarts.init(domBing1);
var optionbing1 = {
    backgroundColor: '#2c343c',

    title: {
        text: 'Customized Pie',
        left: 'center',
        top: 20,
        textStyle: {
            color: '#ccc'
        }
    },

    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },

    visualMap: {
        show: false,
        min: 80,
        max: 600,
        inRange: {
            colorLightness: [0, 1]
        }
    },
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '50%'],
            data:[
                {value:335, name:'班组1'},
                {value:310, name:'班组2'},
                {value:274, name:'班组3'},
                {value:235, name:'班组4'},
                {value:400, name:'班组5'}
            ].sort(function (a, b) { return a.value - b.value; }),
            roseType: 'radius',
            label: {
                normal: {
                    textStyle: {
                        color: 'rgba(255, 255, 255, 0.3)'
                    }
                }
            },
            labelLine: {
                normal: {
                    lineStyle: {
                        color: 'rgba(255, 255, 255, 0.3)'
                    },
                    smooth: 0.2,
                    length: 10,
                    length2: 20
                }
            },
            itemStyle: {
                normal: {
                    color: '#c23531',
                    shadowBlur: 200,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },

            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function (idx) {
                return Math.random() * 200;
            }
        }
    ]
};
if (optionbing1 && typeof optionbing1 === "object") {
    myChart_b1.setOption(optionbing1, true);
}


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

//   环卫工管理----------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo8'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
      // 添加设备
      $(".add_manager").click(function(){
          layer.open({
              type:1,
              title:"添加管理员",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#addManager_sa"), 
              yes:function(index){
                  // $.ajax({
                  //     url:"",
                  //     type:"POST",
                  //     data:"",
                  //     cache:false,
                  //     success:function(res){
  
                  //     }
                  // })
  
                  layer.close(index);
              }
          })
      })
      // 修改
      $(".reset_manager").click(function(){
          form.render('select'); 
  
          layer.open({
              type:1,
              title:"管理员信息修改",
              btn:["确定","取消"],
              area:["600px","450px"],
              content:$("#resetManager_sa"),
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

//  垃圾数量统计表---------------------------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo10'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
      
      form.render('checkbox');
  })
  // <!-- 发送时间 -->
  layui.use('laydate', function(){
      var laydate = layui.laydate;
      laydate.render({
          elem:"input[name='startTime']",
      })
      laydate.render({
          elem:"input[name='endTime']",
      })
  });
  // <!-- 总数量 -->
  var len = $(".tbody>tr").length;     
  $(".len").html(len);
  
  
  // <!-- 城市 区县。。。navbar -->
  $(".nav>.navbar").click(function(){
      $(this).addClass("active").siblings().removeClass("active");
      var index = $(this).index();
      $(".navChild>p").eq(index).removeClass("hide").siblings().addClass("hide");
  
  })
  // <!-- 选择省市区街道班组 的全部  触发 -->
  function oClick(obj){
      obj.css({"background":"#1AA194","color":"#fff"}).siblings().prop("disabled",true);
  }
  
  
  // <!-- tabnav切换 -->
  $(".tabnav>span").click(function(){
      $(this).addClass("tab_active").siblings().removeClass("tab_active");
      var index = $(this).index();
      $(".tab_child>div").eq(index).removeClass("hide").siblings().addClass("hide");
  })
  
  // <!-- 折线图 -->
  var domLineSum = document.getElementById("point_line_sum");
  var myChartSum = echarts.init(domLineSum);
  var optionlineSum = {
      title: {
          text: '折线图堆叠'
      },
      tooltip: {
          trigger: 'axis'
      },
      legend: {
          data:['班组1','班组2','班组3','班组4','班组5'],
          left:"50%",
          top:5
      },
      grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
      },
      toolbox: {
          feature: {
              saveAsImage: {}
          }
      },
      xAxis: {
          type: 'category',
          boundaryGap: false,
          data: ['周一','周二','周三','周四','周五','周六','周日']
      },
      yAxis: {
          type: 'value'
      },
      series: [
          {
              name:'班组1',
              type:'line',
              stack: '总量',
              data:[120, 132, 101, 134, 90, 230, 210]
          },
          {
              name:'班组2',
              type:'line',
              stack: '总量',
              data:[220, 182, 191, 234, 290, 330, 310]
          },
          {
              name:'班组3',
              type:'line',
              stack: '总量',
              data:[150, 232, 201, 154, 190, 330, 410]
          },
          {
              name:'班组4',
              type:'line',
              stack: '总量',
              data:[320, 332, 301, 334, 390, 330, 320]
          },
          {
              name:'班组5',
              type:'line',
              stack: '总量',
              data:[820, 932, 901, 934, 1290, 1330, 1320]
          }
      ]
  };
  
  if (optionlineSum && typeof optionlineSum === "object") {
      myChartSum.setOption(optionlineSum, true);
  }
  
  
  // <!-- 饼图 -->
  var domBingSum = document.getElementById("bing_num");
  var myChart_sum = echarts.init(domBingSum);
  var optionbingSum = {
      backgroundColor: '#2c343c',
  
      title: {
          text: 'Customized Pie',
          left: 'center',
          top: 20,
          textStyle: {
              color: '#ccc'
          }
      },
  
      tooltip : {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
      },
  
      visualMap: {
          show: false,
          min: 80,
          max: 600,
          inRange: {
              colorLightness: [0, 1]
          }
      },
      series : [
          {
              name:'访问来源',
              type:'pie',
              radius : '55%',
              center: ['50%', '50%'],
              data:[
                  {value:335, name:'班组1'},
                  {value:310, name:'班组2'},
                  {value:274, name:'班组3'},
                  {value:235, name:'班组4'},
                  {value:400, name:'班组5'}
              ].sort(function (a, b) { return a.value - b.value; }),
              roseType: 'radius',
              label: {
                  normal: {
                      textStyle: {
                          color: 'rgba(255, 255, 255, 0.3)'
                      }
                  }
              },
              labelLine: {
                  normal: {
                      lineStyle: {
                          color: 'rgba(255, 255, 255, 0.3)'
                      },
                      smooth: 0.2,
                      length: 10,
                      length2: 20
                  }
              },
              itemStyle: {
                  normal: {
                      color: '#c23531',
                      shadowBlur: 200,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                  }
              },
  
              animationType: 'scale',
              animationEasing: 'elasticOut',
              animationDelay: function (idx) {
                  return Math.random() * 200;
              }
          }
      ]
  };
  if (optionbingSum && typeof optionbingSum === "object") {
      myChart_sum.setOption(optionbingSum, true);
  }
  
//   垃圾溢出情况统计表-----------------------------------------------------------------------------
layui.use('element', function(){
    var element = layui.element();  //依赖
  });
  layui.use(["layer",'laypage'],function(){
      var layer = layui.layer,
          laypage = layui.laypage;
          laypage({
              cont: 'demo11'
              ,pages: 100 //总页数
              ,groups: 5 //连续显示分页数
          });
  })
  layui.use("form",function(){
      var form = layui.form();
      
      form.render('checkbox');
  })
  // <!-- 发送时间 -->
  layui.use('laydate', function(){
      var laydate = layui.laydate;
      laydate.render({
          elem:"input[name='startTime']",
      })
      laydate.render({
          elem:"input[name='endTime']",
      })
  });
  // <!-- 总数量 -->
  var len = $(".tbody>tr").length;     
  $(".len").html(len);
  
  
  // <!-- 城市 区县。。。navbar -->
  $(".nav>.navbar").click(function(){
      $(this).addClass("active").siblings().removeClass("active");
      var index = $(this).index();
      $(".navChild>p").eq(index).removeClass("hide").siblings().addClass("hide");
  
  })
  // <!-- 选择省市区街道班组 的全部  触发 -->
  function oClick(obj){
      obj.css({"background":"#1AA194","color":"#fff"}).siblings().prop("disabled",true);
  }
  
  
  // <!-- tabnav切换 -->
  $(".tabnav>span").click(function(){
      $(this).addClass("tab_active").siblings().removeClass("tab_active");
      var index = $(this).index();
      $(".tab_child>div").eq(index).removeClass("hide").siblings().addClass("hide");
  })
  
  // <!-- 折线图 -->
  var domLineNum = document.getElementById("point_line_over");
  var myChart_num = echarts.init(domLineNum);
  var optionlineNum = {
      title: {
          text: '折线图堆叠'
      },
      tooltip: {
          trigger: 'axis'
      },
      legend: {
          data:['班组1','班组2','班组3','班组4','班组5'],
          left:"50%",
          top:5
      },
      grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
      },
      toolbox: {
          feature: {
              saveAsImage: {}
          }
      },
      xAxis: {
          type: 'category',
          boundaryGap: false,
          data: ['周一','周二','周三','周四','周五','周六','周日']
      },
      yAxis: {
          type: 'value'
      },
      series: [
          {
              name:'班组1',
              type:'line',
              stack: '总量',
              data:[120, 132, 101, 134, 90, 230, 210]
          },
          {
              name:'班组2',
              type:'line',
              stack: '总量',
              data:[220, 182, 191, 234, 290, 330, 310]
          },
          {
              name:'班组3',
              type:'line',
              stack: '总量',
              data:[150, 232, 201, 154, 190, 330, 410]
          },
          {
              name:'班组4',
              type:'line',
              stack: '总量',
              data:[320, 332, 301, 334, 390, 330, 320]
          },
          {
              name:'班组5',
              type:'line',
              stack: '总量',
              data:[820, 932, 901, 934, 1290, 1330, 1320]
          }
      ]
  };
  
  if (optionlineNum && typeof optionlineNum === "object") {
      myChart_num.setOption(optionlineNum, true);
  }
  
  
  // <!-- 饼图 -->
  var domBingNum = document.getElementById("bing_num");
  var myChartNum = echarts.init(domBingNum);
  var optionbingNum = {
      backgroundColor: '#2c343c',
  
      title: {
          text: 'Customized Pie',
          left: 'center',
          top: 20,
          textStyle: {
              color: '#ccc'
          }
      },
  
      tooltip : {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
      },
  
      visualMap: {
          show: false,
          min: 80,
          max: 600,
          inRange: {
              colorLightness: [0, 1]
          }
      },
      series : [
          {
              name:'访问来源',
              type:'pie',
              radius : '55%',
              center: ['50%', '50%'],
              data:[
                  {value:335, name:'班组1'},
                  {value:310, name:'班组2'},
                  {value:274, name:'班组3'},
                  {value:235, name:'班组4'},
                  {value:400, name:'班组5'}
              ].sort(function (a, b) { return a.value - b.value; }),
              roseType: 'radius',
              label: {
                  normal: {
                      textStyle: {
                          color: 'rgba(255, 255, 255, 0.3)'
                      }
                  }
              },
              labelLine: {
                  normal: {
                      lineStyle: {
                          color: 'rgba(255, 255, 255, 0.3)'
                      },
                      smooth: 0.2,
                      length: 10,
                      length2: 20
                  }
              },
              itemStyle: {
                  normal: {
                      color: '#c23531',
                      shadowBlur: 200,
                      shadowColor: 'rgba(0, 0, 0, 0.5)'
                  }
              },
  
              animationType: 'scale',
              animationEasing: 'elasticOut',
              animationDelay: function (idx) {
                  return Math.random() * 200;
              }
          }
      ]
  };
  if (optionbingNum && typeof optionbingNum === "object") {
      myChartNum.setOption(optionbingNum, true);
  }