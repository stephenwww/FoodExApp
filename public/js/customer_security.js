$(document).ready(function(){
 
  $("#change-email").click(function() {
    $(".edit-area").hide();
    $(".data-area").hide();
    $("#email .edit-area").show();
    //$("#email .data-area").hide();

	});


  $("#change-pwd").click(function() {
    $(".edit-area").hide();
    $(".data-area").hide();
  	$("#pwd .edit-area").show();
  });

  $(".cancel-edit").click(function(event) {
    event.preventDefault();
    $(".edit-area").hide();
    $(".data-area").show();
  });
});