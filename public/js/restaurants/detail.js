$(document).ready(function() 
{
    btn_order_click();
    btn_plus_click();
    btn_minus_click();
    change_price( $("form.form-order") );
});

function btn_order_click()
{
	$("button.btn-order").click( function()
	{
		$form_order = $("form.form-order");
		$form_group = $form_order.children("div.form-group#" + $(this).attr("dish-id"));
		if ($form_group.length == 0)
		{
			add_new_dish($form_order, $(this));
		} else
		{
			increment_quantity($form_group);
		}
/*        $.post('../../order/dish-quantity-change', 
        	{ "dish_id": $(this).attr("dish-id"), "quantity_increment": true},
        	function( data )
        	{
        		alert(data);
        	});*/
	});
}

function add_new_dish(form_order, btn)
{
	$div_form_group = $("<div class=\"form-group form-dish\" id=\"" +  $(btn).attr("dish-id") + "\"></div>").appendTo($form_order);

	$div_dish_name = $("<div class=\"col-md-6\" name=\"dish-name\">" + $(btn).attr("dish-name") + "</div>");
	$div_dish_price = $("<div class=\"col-md-2\" name=\"dish-price\" value=\"" + 
		$(btn).attr("dish-price") + "\">$" + $(btn).attr("dish-price") + "</div>");
	$div_btn_plus = $("<div class=\"col-md-1\" style=\"padding: 0px 0px\">+</div>").html(
		$("<button class=\"btn-plus btn btn-sm\" dish-id=\"" + $(btn).attr("dish-id") + "\">+</button>").on("click", function(event)
		{
            event.preventDefault();
/*            $.post('../order/dish-quantity-change', 
            	{ dish_id: $(this).attr("dish-id"), quantity_increment: true})
            	.done(function( data )
            	{
            		alert(data);
            	});*/
            increment_quantity($("div.form-group#" + $(btn).attr("dish-id")));
        })
	);
	$div_dish_quantity = $("<div class=\"col-md-1\" name=\"dish-quantity\"  \
		style=\"text-align:center; padding: 0px 2px 0px 0px\">1</div>");
	$div_btn_minus = $("<div class=\"col-md-1\" style=\"padding: 0px 0px\">-</div>").html(
		$("<button class=\"btn-minus btn btn-sm\" dish-id=\"" + $(btn).attr("dish-id") + "\">-</button>").on("click", function(event) 
		{
            event.preventDefault();
/*            $.post('../order/dish-quantity-change', 
            	{ dish_id: $(this).attr("dish-id"), quantity_increment: false})
            	.done(function( data )
            	{
            		alert(data);
            	});*/
            decrement_quantity($("div.form-group#" + $(btn).attr("dish-id")));
        })
	);
	$input_dish_id = $("<input name=\"dish_id[]\" type=\"hidden\" value=\"" + $(btn).attr("dish-id") + "\">");
	$input_dish_quantity = $("<input name=\"dish_quantity[]\" type=\"hidden\" value=\"1\">")

	$div_dish_name.appendTo( $div_form_group );
	$div_dish_price.appendTo( $div_form_group );
	$div_btn_plus.appendTo( $div_form_group );
	$div_dish_quantity.appendTo( $div_form_group );
	$div_btn_minus.appendTo( $div_form_group );
	$input_dish_id.appendTo( $div_form_group );
	$input_dish_quantity.appendTo( $div_form_group );

	$div_form_group.prependTo( $form_order );

	change_price($form_order);
}

function btn_plus_click()
{
	$("button.btn-plus").click( function(event) 
	{
		event.preventDefault();
        increment_quantity( $("div.form-group#" + $(this).attr("dish-id")) );		
	});
}

function btn_minus_click()
{
	$("button.btn-minus").click( function() 
	{
		event.preventDefault();		
		decrement_quantity( $("div.form-group#" + $(this).attr("dish-id")) );
	}) 
}

function increment_quantity(form_dish)
{
	var new_quantity = parseInt(form_dish.children('div[name=\"dish-quantity\"]').html()) + 1;
	form_dish.children('div[name=\"dish-quantity\"]').html(new_quantity);
	form_dish.children('input[name=\"dish_quantity[]\"]').attr("value", new_quantity);
	change_price(form_dish.parent());	
}

function decrement_quantity(form_dish)
{
	var new_quantity = parseInt(form_dish.children('div[name=\"dish-quantity\"]').html()) - 1;
	form_dish.children('div[name=\"dish-quantity\"]').html(new_quantity);
	form_dish.children('input[name=\"dish_quantity[]\"]').attr("value", new_quantity);
	change_price(form_dish.parent());	
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
		cnt = cnt + parseInt($(this).children('div[name=\"dish-quantity\"]').html())
		price = price + parseInt($(this).children('div[name=\"dish-quantity\"]').html()) 
					* parseInt($(this).children('div[name=\"dish-price\"]').attr("value"));
	});
	form_order.find("label#lb-total-cnt").html(cnt + " Item");
	form_order.find("label#lb-total-price").html("$" + price);
}