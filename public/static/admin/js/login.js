// <!-- 折线图 -->
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

// if (optionline1 && typeof optionline1 === "object") {
//     myChart1.setOption(optionline1, true);
// }

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













 