function a(){$.ajax({url:"/api/record/mypage?id=",method:"GET",dataType:"json"}).done(function(t){t!="undefined"&&($.each(t.map_data,function(e,n){$("#place_name"+e).html(n.title.substring(0,7)),$("#place_link"+e).attr("href","/api/record?map_id="+n.map_id)}),$.each(t.map_attachment,function(e,n){$("#place_img"+e).html(n)}))}).fail(function(t,e,n){console.log("error")})}a();