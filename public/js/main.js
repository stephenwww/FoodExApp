$(document).ready(function() {

	var url = window.location.pathname;
	var pill;
	switch(url){
	case "/":
		pill = $('#g'); break;
	case "/customer/management":
		pill = $('#cm'); break;
	case "/customer/orders":
		pill = $('#co'); break;
	case "/restaurant":
		pill = $('#rest'); break;
	case "/restaurant/manage-profile":
		pill = $('#rmp'); break;
	case "/restaurant/add-dish":
		pill = $('#rmd'); break;
	case "/restaurant/manage-dishes":
		pill = $('#rmd'); break;
	case "/restaurant/orders":
		pill = $('#ro'); break;
	case "/restaurant/order-statistics":
		pill = $('#ros'); break;
	case "/user/logout":
		pill = $('#ulo'); break;
	case "/user/login":
		pill = $('#uli'); break;
	case "/user/customer-signup":
		pill = $('#ucs'); break;
	case "/user/restaurant-signup":
		pill = $('#urs'); break;
	case "/admin/restaurant-management":
		pill = $('#arm'); break;
	case "/admin/operations":
		pill = $('#aop'); break;
	case "/admin/past-operation":
		pill = $('#apo'); break;			
	default:
		if(url.indexOf("detail") > -1){
			pill = $('#g'); break;
		}
		pill = null; break;
	}
	if(pill){
		pill.addClass('active');
	}
});