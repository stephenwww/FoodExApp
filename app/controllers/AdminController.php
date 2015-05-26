<?php

require_once(app_path().'/includes/macro.php');

class AdminController extends BaseController 
{
	protected $layout = 'layouts.main';

	public function __construct()
	{
		$this->beforeFilter('admin', array('on'=>'get'));
	}

	public function getIndex()
	{
		return $this->getRestaurantManagement();
	}

	public function getRestaurantManagement()
	{
		return View::make('admins.restaurant-management')
			->with('restaurants', Restaurant::all());
	}

	public function getActiveRestaurant($res_id)
	{
		return $this->restaurant_management($res_id, true);
	}

	public function getDeactiveRestaurant($res_id)
	{
		return $this->restaurant_management($res_id, false);		
	}

	public function getPastOperation()
	{
		return View::make('admins.past-operation')
			->with('operations', AdminOperation::orderBy('op_time', 'desc')->paginate(8));
	}


	/******************* private funtion below *********************/
	private function restaurant_management($res_id, $legitimate)
	{
		$restaurant = Restaurant::find($res_id);
		$restaurant->legitimate = $legitimate;
		$restaurant->save();

		$operation = new AdminOperation;
		$operation->admin_id = Session::get('role_id');
		$operation->res_id = $res_id;
		$operation->op_type = constant("ACTIVE");
		$operation->op_time = date('Y-m-d H:i:s');
		$operation->save();

		$user = User::find($restaurant->user_id);
		$this->send_notification_email($restaurant, $user, $legitimate);
		return Redirect::to('admin');
	}


	/****************** wrote by other guys *************************/
	public function getOperations() 
	{
		$cuisines = Cuisine::all();
		$tax = Tax::getTax();
		return View::make('admins.operations')
			->with('cuisines', $cuisines)
			->with('current_tax', $tax);
	}

	public function postRemoveCuisines(){
		$victimCuisineIds = Input::all();
		unset($victimCuisineIds['_token']);
		foreach($victimCuisineIds as $cuisineId){
			DB::statement('DELETE from cuisines where cuisine_id = ?', array($cuisineId));
		}
		return Redirect::back();
	}

	public function postAddCuisine(){
		$newCuisine = Input::get('cuisine_name');
		$exist = Cuisine::where(array('cuisine_name' => $newCuisine))->get();


		if(count($exist) != 0){ // already exists in db
			return Redirect::back()
				->withErrors('Cannot add. This cuisine already exists.');			
		}

		DB::statement('INSERT INTO cuisines(cuisine_name) VALUES(?)',
		array($newCuisine));	

		return Redirect::back();	
	}

	public function postEditTax(){
		$newTax = Input::get('tax');

		$validator = Validator::make(Input::all(), array(
			'tax' => 'digits_between:1,2',
		));

		if($validator->passes()){
			DB::statement('UPDATE tax set tax_percentage = ?', array($newTax));
			return Redirect::back();
		}
		
		return Redirect::back()->withErrors($validator);
	}

	// where this func will be called? 
	private function send_notification_email($restaurant, $user, $is_activate)
	{
		if($is_activate){
			Mail::queue('emails.activate-notification', array('username' => $restaurant->res_name), function($message) use ($user){
				$message->to($user->email, $user->username)->subject("[FoodExApp] Your Restaurant Has been activated.");
			});
		}
	}
}

?>