layui.use(['element','layer'], function(){
    var layer   = layui.layer,
        element = layui.element;

    // 绑定信息确认
    function bindinfo(trash,obj){
      trash.on('click',function(){
        var trashNum = $(this).html();
        obj.html(trashNum);
      })
    };
              
    var trash = $(".trash_num"),bind1 = $(".bind1"),hwer = $(".huanwei"),bind2 = $(".bind2");
    bindinfo(trash,bind1);
    bindinfo(hwer,bind2);

    // 垃圾桶绑定信息------环卫工绑定信息
    function managerInfo(){
      var index = layer.open({
        title: '垃圾桶绑定信息'
        ,content: 'table框',
        btn:'关闭窗口',
        btnAlign:'c',
        area:['500px','400px'],
        yes:function(){

          layer.close(index);
        }
      })
    }
    // 垃圾桶管理
    $(".trashManager").on('click',function(){

      managerInfo()
    })
    // 环卫工管理
    $(".hwManager").on('click',function(){
      
      managerInfo()
    })
})