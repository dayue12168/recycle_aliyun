layui.use(['element','layer'], function(){
    var layer   = layui.layer,
        element = layui.element;

     // thead中tr固定
    var oTop1 = $(".oTable1 thead>tr");
    var oTop2 = $(".oTable2 thead>tr");
    var oTop1Top = $(".oTable1 thead>tr").offset().top;
    var oTop2Top = $(".oTable2 thead>tr").offset().top;
    var sTop = 0;

    function oScroll(a,b){
        
        sTop = $(window).scrollTop();
        console.log(sTop)
        if(sTop > a-40){   //-100  防止抖动
          b.addClass("Top_0");
          $(".totop").show();
        }else if(sTop == 0){
          b.removeClass("Top_0");
          $(".totop").hide();
        }
      
    };

    $(window).scroll(function(){
      oScroll(oTop1Top,oTop1);
      oScroll(oTop2Top,oTop2);
    });
 
})