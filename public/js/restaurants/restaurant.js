$(document).ready(function() {
	$("#btn-resend-email").click(function(){
		$.get( "user/resend-email", function( data ) {
			$("#msg-email ul").append("<li>"+data+"</li>");
		});
	});
});
