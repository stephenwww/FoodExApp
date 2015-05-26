$(document).ready(function(){
 
  $(".caption").hover(function() {
    var pop_id = $(this).attr('value');
    $('#'+pop_id).show();
	}, function() {
    var pop_id = $(this).attr('value');
    $('#'+pop_id).hide();
  });

});