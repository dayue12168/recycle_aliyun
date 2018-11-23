function Chang(obj){
    // obj.next().find("option").remove();
    var _val = obj.val();
    var that = obj;
    // console.log(that);
    $.ajax({
        url:"/admin/Address/getChildAddr",
        type:"post",
        data:{'addr':_val},
        cache:false,
        success:function(res){
            // console.log(res);
            var data;
            for(var i in res){
                // data=res[i];
                var _that = that.eq(i+1).val();
                // console.log(_that);
                for(var j in data){
                    // console.log('mmmm');
                    // var options = "<option>"+data[j].area_name+"</option>";
                    // _that.html(data[j].area_name);
                }
            }
            // console.log(res[2][0]);
            // console.log(res.length);
            // for(var i = 1; i<= res.length ; i++){
                // console.log(res[i][0]);
                // console.log(res[1][0]);
                // console.log('bbbbbb');
                // for(var j = 0;j<res[i].length;j++){
                //     console.log('aaaaa');
                //     // var option = "<option value='"+res[i][j].area_id+"'>"+res[i][j].area_name+"</option>";
                //     // that.next().html(option);
                // }

                // if(res[i].area_level == 2){
                // var option = "<option value='"+res[i].area_id+"'>"+res[i].area_name+"</option>";
                // that.next().append(option);
                // }
            // }
        }
    })
}
