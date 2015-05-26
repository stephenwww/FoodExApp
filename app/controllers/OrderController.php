<?php

require_once(app_path().'/includes/macro.php');

class OrderController extends BaseController
{
	protected $layout = "layouts.main";

	public function __construct()
	{
		$this->beforeFilter('order_get_put_review', array('only' => 
			array('getReview', 'putReview')));
		$this->beforeFilter('order_post_review', array('only' => 
			'postReview'));
		$this->beforeFilter('order_confirm', array('only' => 
			array('getConfirm', 'postConfirmDone')));	

		$this->beforeFilter('restaurant', array('only' => 
			array('getRestaurantOrders', 'getRestaurantIncome')));
		$this->beforeFilter('restaurant_get_order_or_income', array('only' => 
			array('getRestaurantOrders', 'getRestaurantIncome')));
	}

	public function getReview() {
		$order = Order::find(Input::get('id'));
		return View::make('orders/review', array('order' => $order));
	}

	public function putReview() {
		$review = Review::find(Input::get('id'));
		$review->review_score = Input::get('score');
		$review->review_content = Input::get('comment');
		$review->save();
		
		return Redirect::to('customer/orders');
	}

	public function postReview() 
	{
		$review = new Review;
		$review->order_id = Input::get('order_id');
		$review->cust_id = Input::get('cust_id');
		$review->res_id = Input::get('res_id');
		$review->review_score = Input::get('score');
		$review->review_content = Input::get('comment');
		$review->save();
		
		return Redirect::to('customer/orders');
		//return $review;
	}

	public function getRestaurantIncome($type, $res_id) {
		$res_income = "invalid type";
		if ($type == "day"){
			$res_income = DB::table('orders')
					->select(	DB::raw('sum(order_price) as income'),
								DB::raw('DATE(order_time) as time'))
					->where('res_id', '=', $res_id)
					->where('order_time', '>=', new DATETIME('-30 days'))
					->groupBy('time')
					->orderBy('time', 'ASC')
					->get();
		} elseif ($type == "week"){
			$res_income = DB::table('orders')
					->select(	DB::raw('sum(order_price) as income'),
								DB::raw('min(order_time) as time'),
								DB::raw('CONCAT(YEAR(order_time), \'-\', WEEK(order_time, 1)) as time_diff'))
					->where('res_id', '=', $res_id)
					->where('order_time', '>=', new DATETIME('-30 days'))
					->groupBy('time_diff')
					->orderBy('time_diff', 'ASC')
					->get();
			//set date as the sunday of that week
			foreach ($res_income as $entry) {
				 $date = new DATETIME($entry->time);
				 $sunday = strtotime('this sunday', $date->getTimestamp());
				 $entry->time = date("Y-m-d", $sunday);
			}
		} elseif ($type == "month") {
			$res_income = DB::table('orders')
	    			->select(	DB::raw('CONCAT(YEAR(order_time), \'-\', MONTH(order_time)+1) as time'),
	    						DB::raw('sum(order_price) as income'))
	    			->where('res_id', '=', $res_id)
	    			->where('order_time', '>=', new DATETIME('-730 days'))
	                ->groupBy('time')
	                ->orderBy('time', 'ASC')
	                ->get();
		}

		return $res_income;
	}

	public function getRestaurantOrders($type, $res_id) {
		$res_order = 'invalid type';
		if ($type == "day"){
			$res_order = DB::table('orders')
	                ->select(	DB::raw('DATE(order_time) as time'), 
	                			DB::raw('count(*) as order_num'))
	                ->where('res_id', '=', $res_id)
	                ->where('order_time', '>=', new DATETIME('-30 days'))
	                ->groupBy('time')
	                ->orderBy('time', 'ASC')
	                ->get();
	    } elseif ($type == "week") {
	    	//$last_day = date('Y-m-d');
	    	$res_order = DB::table('orders')
	    			->select(	DB::raw('min(DATE(order_time)) as time'),
	    						DB::raw('CONCAT(YEAR(order_time), \'-\', WEEK(order_time, 1)) as time_diff'),
	    						DB::raw('count(*) as order_num'))
	    			->where('res_id', '=', $res_id)
	    			->where('order_time', '>=', new DATETIME('-365 days'))
	                ->groupBy('time_diff')
	                ->orderBy('time_diff', 'ASC')
	                ->get();
	        foreach ($res_order as $entry) {
				 $date = new DATETIME($entry->time);
				 $sunday = strtotime('this sunday', $date->getTimestamp());
				 $entry->time = date("Y-m-d", $sunday);
			}
	    } elseif ($type == "month") {
	    	$res_order = DB::table('orders')
	    			->select(	DB::raw('CONCAT(YEAR(order_time), \'-\', MONTH(order_time)+1) as time'),
	    						DB::raw('count(*) as order_num'))
	    			->where('res_id', '=', $res_id)
	    			->where('order_time', '>=', new DATETIME('-730 days'))
	                ->groupBy('time')
	                ->orderBy('time', 'ASC')
	                ->get();
	    }
		return $res_order;
	}

	public function getConfirm()
	{
		$customer_order = Session::get('customer_order');
		return View::make('orders.confirm')
			->with('res_id', $customer_order['res_id'])
			->with('cust_id', $customer_order['cust_id'])
			->with('dish_id', $customer_order['dish_id'])
			->with('dish_quantity', $customer_order['dish_quantity'])
			->with('addresses', CustAddr::where('cust_id', '=', $customer_order['cust_id'])->get())
			->with('cnt', count($customer_order['dish_id']));
	}

	public function postConfirmDone() 
	{	
		if ( Input::get('order_service_type')!=constant("DELIVERY")
			|| Input::get('cust_addr_id')!=null )
		{
			$this->insert_order(Input::all());
			$this->insert_order_dish(Input::all());
			$this->session_destructor();
			return Redirect::to('customer/orders');
		} else 
		{
			return Redirect::to('order/confirm')
				->withErrors("Please choose your address for delivery service.")
				->withInput();
		}
	}	


/**********************************  private function below ************************************/
/*	private function session_constructor()
	{
		Session::put('customer_order', Input::all());
		Session::put('customer_is_ordering', true);
	}*/
	private function session_destructor()
	{
		Session::forget('customer_order');
		Session::forget('customer_is_ordering');
	}
	private function insert_order($input)
	{
		$order_price = 0;
		for ($i = 0; $i < count($input['dish_id']); ++ $i)
		{
			$dish = Dish::find($input['dish_id'][$i]);
			$order_price += ($input['dish_quantity'][$i] * $dish->dish_price);
		}
		$order = new Order;
		$order->cust_id = $input['cust_id'];
		$order->res_id = $input['res_id'];
		$order->cust_addr_id = $input['order_service_type']==constant("DELIVERY")?
			$input['cust_addr_id']: null;
		$order->order_time = date('Y-m-d H:i:s');
		$order->order_price = $order_price;
		$order->order_service_type = $input['order_service_type'];
		$order->save();
		return DB::getPdo()->lastInsertId();		
	}
	private function insert_order_dish($input)
	{
		// we use Pdo here instead of the ret value of insert_order				
		$order_id = DB::getPdo()->lastInsertId();
		for ($i = 0; $i < count($input['dish_id']); ++ $i)
		{
			$order_dish = new OrderDish;
			$order_dish->order_id = $order_id;
			$order_dish->dish_id = $input['dish_id'][$i];
			$order_dish->dish_amount = $input['dish_quantity'][$i];
			$order_dish->save();
		}
		/***************************
		* Reviews
		*---------------------------
		* review_id
		* res_id
		* order_id
		* cust_id
		* review_content
		* review_score
		****************************/
		$order_review = new Review;
		$order_review->res_id = $input['res_id'];
		$order_review->order_id = $order_id;
		$order_review->cust_id = $input['cust_id'];
		$order_review->review_content = "None";
		$order_review->review_score =0;
		$order_review->save();
	}	

	public function getTest()
	{
		return "getTest";
	}

}



/*	// ajax, update dish_quantity&&dish_id session
	public function postDishQuantityChange()
	{	
//		return Input::get('quantity_increment');
		$customer_order = Session::get('customer_order');
//		return "before search";
		$index = array_search(intval(Input::get('dish_id')), $customer_order['dish_id']);
		return "before if";
		if (Input::get('quantity_increment') == "true")
		{
			return "true";
			$customer_order['dish_quantity'][$index] += 1;
		} else 
		{
			return "false";
			$customer_order['dish_quantity'][$index] -= 1;
			// if quantity decrement to 0, just remove
			if ($customer_order['dish_quantity'][$index] == 0)
			{
				unset($customer_order['dish_id'][$index]);				
				unset($customer_order['dish_quantity'][$index]);
			}
		}
		Session::put('customer_order', $customer_order);
	}*/
?>