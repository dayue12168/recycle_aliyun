 
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


$(".Jquery").click(function(){
    var ctime=$("input[name=startTime]").val();
    var etime=$("input[name=endTime]").val();
    $.ajax({
        url:"/admin/count/queryOverflow",
        type:"post",
        data:{'ctime':ctime,'etime':etime},
        success:function(res){
            var tb=$(".tbody");
            var str='';
            for(var i in res){
                str +='<tr><td>'+res[i].pro+'-'+res[i].city+'-'+res[i].district+
                    '</td><td>1</td><td>'+res[i].total+
                    '</td><td></td><td>'+res[i].total+
                    '</td></tr>';
            }
            tb.html(str);
        }
    })
});

$(".excel").click(function(){
    var ctime=$("input[name=startTime]").val();
    var etime=$("input[name=endTime]").val();
    window.location.href='/admin/count/overflow_excel?ctime='+ctime+"&etime="+etime;

});
  
  
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
  var domBingNum = document.getElementById("bing_over");
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