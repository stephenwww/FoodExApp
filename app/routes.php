<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*leave the main entry point as it was*/
Route::get('/', function()
{
	$cuisines = array('All Cuisines', 0);
	foreach (Cuisine::all() as $cuisine)
	{
		$cuisines[$cuisine->cuisine_id] = $cuisine->cuisine_name;
	}
	return View::make('index')
		->with('restaurants', Restaurant::where('legitimate', '=', true)
			->orderBy('score', 'desc')->get()) // ->get()
		->with('cuisines', $cuisines);
});

/* Routes by Brandon */
Route::controller('user', 'UserController');
Route::get('/test', function(){
	return View::make('restaurants.gallerytemp')
		->with('restaurants', Restaurant::all());
});

/* Routes by Jeremy */
Route::controller('order','OrderController');

/* Routes by Ella */
Route::controller('restaurant', 'RestaurantController');

/* Routes by Stephen */
Route::controller('customer', 'CustomerController');
Route::controller('admin', 'AdminController');

Route::filter('order_get_put_review', 'OrderFilter@get_put_review');
Route::filter('order_post_review', 'OrderFilter@post_review');
Route::filter('order_confirm', 'OrderFilter@confirm');

//Route::filter('user', 'UserFilter');
Route::filter('user_post_signup', 'UserFilter@post_signup');
Route::filter('user_get_post_login', 'UserFilter@get_post_login');
Route::filter('customer', 'CustomerFilter');
Route::filter('customer_post_address', 'CustomerFilter@post_address');
Route::filter('customer_put_address', 'CustomerFilter@put_address');
Route::filter('customer_get_edit_address', 'CustomerFilter@get_edit_address');
Route::filter('customer_post_complete', 'CustomerFilter@post_complete');
Route::filter('restaurant', 'RestaurantFilter');
Route::filter('restaurant_has_dish', 'RestaurantFilter@has_dish');
Route::filter('restaurant_has_order', 'RestaurantFilter@has_order');
Route::filter('restaurant_get_order_or_income', 'RestaurantFilter@get_order_or_income');
Route::filter('admin', 'AdminFilter');

//Route::controller('test', 'TestController');

// following is the reason why session got lost in Jeremy's mac
//Route::filter('test', 'TestFilter');
//Route::filter('test_test', 'TestFilter@test');

?>