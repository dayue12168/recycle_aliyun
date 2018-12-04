layui.use('form', function() {
    var form = layui.form();
    form.on("select(address)",function(data){
        console.log($(".layui-form input.layui-unselect").eq(1).val())
        var _val = data.value;
        var child=$(this).parent().parent().nextAll('select');
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
                                form.render();
                                var city=$(".layui-form input.layui-unselect").eq(0).val();
                                var area=$(".layui-form input.layui-unselect").eq(1).val();
                                var areaId=$("dd.layui-this").eq(1).attr('lay-value');
                                var street=$(".layui-form input.layui-unselect").eq(2).val();
                                var streetId=$("dd.layui-this").eq(2).attr('lay-value');
                                // console.log($(".layui-form input.layui-unselect").eq(i).val());
                                $('#Jregion').text(city+'---'+area).attr('Jdata',areaId);
                                $('#Jroad').text(area+'---'+street).attr('Jdata',streetId);
                                $('#JJroad').text(street).attr('Jdata',streetId);
                            }
                        }
                    }
                });
            }
        });
    });

});


