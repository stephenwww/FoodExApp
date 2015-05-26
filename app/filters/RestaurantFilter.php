<?php

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class RestaurantFilter
{
	public function filter()
	{
		if (Session::has('role') == false 
			|| Session::get('role') != constant("RESTAURANT"))
		{
			return Redirect::to('user/login');
		}		
	}

	// edit dish, delete dish
	public function has_dish()
	{
		try 
		{		
			if (Dish::findOrFail(Input::get('dish_id'))->res_id != Session::get('role_id'))
			{
				return "You cannot operate on other restaurants' dishes.";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such dish!', 404);
		}
	}

	public function has_order()
	{
		try 
		{
			if (Order::findOrFail(Input::get('id'))->res_id != Session::get('role_id'))
			{
				return "You cannot operate on other restaurants' orders.";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such order!', 404);			
		}
	}

	// called by OrderController::getRestaurantOrders || getRestaurantIncome
	public function get_order_or_income()
	{
		if (Session::get('role_id') != Request::segment(4))
		{
			return "Hey! By no means you can see other restaurants' data.";
		}
	}
}
?>