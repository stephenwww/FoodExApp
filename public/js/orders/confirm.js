$(document).ready(function() 
{
	change_price($("form#form-order"));
	$("button.btn-plus").click(function(event) {
        event.preventDefault();
		increment_quantity( $(".form-dish#" + $(this).attr("dish-id")) );
	});
	$("button.btn-minus").click(function(event) {
		event.preventDefault();
        decrement_quantity( $(".form-dish#" + $(this).attr("dish-id")) );
	});
    $("input[name=\"order_service_type\"]:radio").change(function()
    {
//        alert("hi");
//        event.preventDefault();        
        service_type_change( $(this) );
    });
});

function increment_quantity( form_dish )
{
    var new_quantity = parseInt(form_dish.find("label[name=\"dish-quantity\"]").html()) + 1;   
    form_dish.find("label[name=\"dish-quantity\"]").html( new_quantity );
    form_dish.find('input[name=\"dish_quantity[]\"]').attr("value", new_quantity);
    change_price( form_dish.parent() );
}

function decrement_quantity(form_dish)
{
    var new_quantity = parseInt(form_dish.find("label[name=\"dish-quantity\"]").html()) - 1;   
    form_dish.find("label[name=\"dish-quantity\"]").html( new_quantity );
    form_dish.find('input[name=\"dish_quantity[]\"]').html("value", new_quantity);
    change_price( form_dish.parent() );
    if ( new_quantity == 0 )
    {    
        form_dish.remove();
    }
}

function change_price(form_order)
{
    var cnt = 0, price = 0;
    form_order.children("div.form-dish").each(function() 
    {
        cnt = cnt + parseInt($(this).find('label[name=\"dish-quantity\"]').html())
        price = price + parseInt($(this).find('label[name=\"dish-quantity\"]').html()) 
                    * parseInt($(this).find('div[name=\"dish-price\"]').attr("value"));
    });
    form_order.find("label#lb-total-cnt").html(cnt + " Item");
    form_order.find("label#lb-total-price").html("$" + price);
}

function service_type_change(radio)
{
//    alert("change");
    var pickup = 0, delivery = 1;
    if (radio.attr("value") == pickup)
    {
        $("div#div-address").hide();
    } else if (radio.attr("value") == delivery)
    {
        $("div#div-address").show();        
    }
}