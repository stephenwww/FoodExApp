$( document ).ready(function(){

	// id
	var s = $("#review").attr('score');
	$("#review").raty({ 
		path: '../imgs', 
		score: s, 
		starOff : 'star-off-big.png',
  		starOn  : 'star-on-big.png',
  		target : '#hint',
  		click: function(score, evt) {
    		//alert('ID: ' + this.id + "\nscore: " + score );
  		}
  	});
	
	// class
	var s = $(".rest_detail_score").attr("score");
	$(".rest_detail_score").raty({ readOnly: true, score: s, path: '../../imgs' });

/*
//dont know what s doesnt work

	$(".gallery_score").each(function(){
		var s = $(this).attr('score');
		alert(s);
		$(".gallery_score").raty({ readOnly: true, score: s, path: 'imgs' });
	});
*/

	// class
	var ppath = $('.gallery_score').attr('data-path');
	$('.gallery_score').raty({ 
  		// path: 'http://localhost/FoodExApp/public/imgs/',
  		path: 'http://cmpt470.csil.sfu.ca:8016/imgs/',
  		//path: 'http://localhost:8000/imgs/',  		
  		score: function() {
    		return $(this).attr('score');
  		},	
  		readOnly: true
	});

	$('.order_score').raty({ 
  		score: function() {
    	return $(this).attr('score');
  	},
  	path: '../imgs',
  	readOnly: true
	});
})




