<?php

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class OrderFilter
{
	public function get_put_review()
	{
		try
		{
			if (Order::findOrFail(Input::get('id'))->cust_id != Session::get('role_id'))
			{
				return "You cannot see or update other customer's review via this URL.";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such order!', 404);
		}
	}

	public function post_review()
	{
		try
		{
			$order = Order::findOrFail(Input::get('order_id'));
			if ($order->cust_id != Input::get('cust_id') || $order->res_id != Input::get('res_id'))
			{
				return "You cannot make review on the order not belonging to you.";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such order!', 404);
		}
	}

	public function confirm()
	{
		if ( Session::get('redirect_from_user_login') == true )
		{
			$customer_order = Session::get('customer_order');
			$customer_order['cust_id'] = Session::get('role_id');
			Session::put('customer_order', $customer_order);
			Session::put('redirect_from_user_login', false);
		} else if ( Input::get('dish_id')!=null || Input::old('dish_id')!=null)
		{
			$this->session_contructor();
		} else if ( Input::get('dish_id')==null && Input::old('dish_id')==null)
		{
			$this->session_destructor();
			return Redirect::to('restaurant/detail/'.Input::get('res_id'))
				->withErrors("Cannot sumbit an empty order.");
		}

		$dish_ids = Session::get('customer_order')['dish_id'];
		try
		{
			for ($i = 0; $i < count($dish_ids); ++ $i)
			{
				$cur_dish = Dish::findOrFail($dish_ids[$i]);
				$res_id = $cur_dish->res_id;
				if (Input::get('res_id')!=null && $res_id!=Input::get('res_id'))
				{
				 	return Redirect::to('restaurant/detail/'.Input::get('res_id'))
				 		->withErrors($cur_dish->dish_name . "belongs to another restaurant, " .
				 					RESTAURANT::find($res_id)->res_name . ".");
				} else if ($i>0 && $cur_dish->res_id!=$prev_dish->res_id)
				{
					return Redirect::to('restaurant/detail/'.Input::get('res_id'))
						->withErrors("Cannot sumbit order containing different restaurants' dishes.");
				}
				$prev_dish = $cur_dish;
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such dish!', 404);
		}

//		return "before if!";
		if (Session::has('role') == false)
		{
//			return "1";
			return Redirect::to('user/login')
				->withErrors("You might want to login in to submit your order.");
		} else if (Session::get('role') == constant("RESTAURANT"))
		{
//			return "2";
			return Redirect::back()
				->withErrors("As a restaurant owner, you cannot sumbit an order.");
		} else if (Session::get('role') == constant("ADMIN"))
		{
//			return "3";
			return Redirect::back()
				->withErrors("As a administrator, you cannot sumbit an order.");
		} else if (User::find(Session::get('user_id'))->is_confirmed_email	== false )
		{
//			return "4";
			return Redirect::back()
				->withErrors("As a customer, you must confirm your email before sumbit an order.");			
		}
//		return "confirm-done";
	}


	/**************** private function below **********************/
	private function session_contructor()
	{
		Session::put('customer_order', Input::get('dish_id')!=null?
			Input::all(): Input::old());
		Session::put('customer_is_ordering', true);		
	}
	private function session_destructor()
	{
		Session::forget('customer_order');
		Session::forget('customer_is_ordering');
	}

/*	private function session_update()
	{  
		$customer_order = Session::get('customer_order');
		$customer_order['dish_id'] = Input::get('dish_id');
		$customer_order['dish_quantity'] = Input::get('dish_quantity');
		$customer_order['res_id'] = Input::get('res_id');
		Session::put('customer_order', $customer_order);
	}*/
}
?>