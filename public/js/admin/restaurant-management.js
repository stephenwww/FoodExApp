$(document).ready(function() {
    $(".btn-change-legitimate").each(function(){
    	var legitimate = $(this).attr("is-legitimate");
    	if (legitimate == true){
    		$(this).addClass("btn-deactive");
    	} else {
    		$(this).addClass("btn-active btn-success");
    	}
    });

    $(".btn-change-legitimate").click(function(){
    	var res_id = $(this).attr("res-id");
    	var legitimate = $(this).attr("is-legitimate");
    	if(legitimate == true){
    		$.get( "admin/active-restaurant/"+res_id, function( data ) {
				if (data == "Success"){
					alert(data);
					$(this).attr("is-legitimate", "0");
					$(this).removeClass("btn-active btn-success").addClass("btn-deactive");
				}
			});
    	} else {
    		$.get( "admin/deactive-restaurant/"+res_id, function( data ) {
				if (data == "Success"){
					$(this).attr("is-legitimate", "1");
					alert("Success");
				}
			});
    	}
    })
});
