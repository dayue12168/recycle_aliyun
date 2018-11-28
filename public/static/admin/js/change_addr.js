$(".Jchange").change(function(){
    var _val = $(this).val();
    var child=$(this).nextAll();
    $.ajax({
        url:"/admin/Address/getChildAddr",
        type:"post",
        data:{'addr':_val},
        cache:false,
        success:function(res){
            $.each(child,function(index,ele){
                $(this).children().remove('option');
                for(var i in res){
                    var data=res[i];
                    for(var j in data){
                        var options = "<option value='"+data[j].area_id+"'>"+data[j].area_name+"</option>";
                        if(index==i){
                            $(this).append(options);
                        }
                    }
                }
            });
        }
    });


// ====================================
$(this).next().click(function(){
    alert("xxx");
})


});


