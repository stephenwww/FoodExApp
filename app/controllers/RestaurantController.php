<?php

class RestaurantController extends BaseController 
{
/*----------------+------------------+------+-----+---------------------+----------------+
 | Field          | Type             | Null | Key | Default             | Extra          |
 +----------------+------------------+------+-----+---------------------+----------------+
 | res_id         | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 | user_id        | int(10) unsigned | NO   | MUL | NULL                |                |
 | res_name       | varchar(255)     | NO   |     | NULL                |                |
 | res_email      | varchar(255)     | NO   |     | NULL                |                |
 | res_tel        | varchar(255)     | NO   |     | NULL                |                |
 | res_country    | varchar(255)     | NO   |     | NULL                |                |
 | res_province   | varchar(255)     | NO   |     | NULL                |                |
 | res_city       | varchar(255)     | NO   |     | NULL                |                |
 | res_street     | varchar(255)     | NO   |     | NULL                |                |
 | res_postalcode | varchar(255)     | NO   |     | NULL                |                |
 | about_us       | varchar(255)     | NO   |     | NULL                |                |
 | is_deliver     | tinyint(1)       | NO   |     | 1                   |                |
 | is_available   | tinyint(1)       | NO   |     | 1                   |                |
 | logo_path      | varchar(255)     | NO   |     | NULL                |                |
 | open_time      | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 | close_time     | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 | score          | float(8,2)       | NO   |     | NULL                |                |
 +----------------+------------------+------+-----+---------------------+----------------*/	

 	protected $layout = "layouts.main";
 	
 	public function __construct()
 	{
 	 	$this->beforeFilter('restaurant', ['except' => 
 	 		['getDetail', 'postSearch']]);
 		$this->beforeFilter('restaurant_has_dish', ['only' => 
 			['getEditDish', 'postEditDish','postDeleteDish']]);
 		$this->beforeFilter('restaurant_has_order', ['only' => 
 			'postComplete']);	
 	}

	public function getIndex() {
		
		$restaurant = Restaurant::find(Session::get('role_id'));
		$user = User::find(Session::get('user_id'));

		return View::make('restaurants.home')
			->with('user', $user)
			->with('restaurant', $restaurant)
			->with('dishes', $restaurant->dishes)
			->with('reshours', $restaurant->restaurantHours())
			->with('googleAPIKey', 'AIzaSyB0VBlkHxOVIQm33CybkivJ3FmvwQVQmSk');
	}


	/*
	 *	Display the form for editing the restaurant's profile information.
	 */
	public function getManageProfile(){

		$restaurant = Restaurant::find(Session::get('role_id'));
		$cuisines = Cuisine::all();
		$othercuisines = $restaurant->otherCuisine();
		$reshours = $restaurant->restaurantHours();

		return View::make('restaurants.manage-profile')
			->with('restaurant', Restaurant::find(Session::get('role_id')))
			->with('cuisines', $cuisines)
			->with('othercuisines', $othercuisines)
			->with('reshours', $reshours);
	}

	public function getManageDishes() {
		$restaurant = Restaurant::find(Session::get('role_id'));
		$dishes = $restaurant->dishes;
		return View::make('restaurants.manage-dishes')
			->with('restaurant', $restaurant)
			->with('dishes', $dishes);
	}


	/*
	 *	Process the form for Contact info from 
	 *	RestaurantController@getManagetProfile()
	 */
	public function postManageContactInfo(){
		$restaurant = Restaurant::find(Session::get('role_id'));
		$user = User::find(Session::get('user_id'));

		$rules = array(
			'res_name' => 'required',
			'res_tel1' =>'required|digits:3',
			'res_tel2' =>'required|digits:3',
			'res_tel3' =>'required|digits:4',
			'res_email' => 'required|email',
		);


		$validator = Validator::make(Input::all(), $rules);
		if($validator->passes()){

			
			$restaurant->res_name = Input::get('res_name');

			// contatenate the telephone number parts
			$res_tel = Input::get('res_tel1').Input::get('res_tel2').Input::get('res_tel3');
			$restaurant->res_tel = $res_tel;
			$restaurant->res_email = Input::get('res_email');
			$restaurant->save();
			$user->email = Input::get('res_email');
			$user->save();
			return Redirect::to('restaurant');

		}
		else{
			return Redirect::back()
				->withErrors($validator)
				->withInput();	
		}

	}

	public function postManageLocation(){
		$restaurant = Restaurant::find(Session::get('role_id'));
		$rules = array(
			'res_street' => 'required',
			'res_city' => 'required',
			'res_province' => 'required',
			'res_country' => 'required',
			'res_postalcode' => 'required'
			);
		$validator = Validator::make(Input::all(), $rules);

		if($validator->passes()){
			$restaurant->update(Input::all());
			return Redirect::to('restaurant');
		}
		else{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}

	}

	public function postManageHours(){

		$restaurant = Restaurant::find(Session::get('role_id'));
		$reshours = $restaurant->restaurantHours();
		$input = Input::all();
		
		/* must check checkboxes individually becuase eloquent ORM
		   does not support getting input from unchecked checkboxes */
		if (array_key_exists('mon_isClosed', $input)) {
    		$reshours->mon_isClosed = 1;
    		unset($input['mon_isClosed']);
		}
		else{
			$reshours->mon_isClosed = 0;
		}
		if (array_key_exists('tues_isClosed', $input)) {
    		$reshours->tues_isClosed = 1;
    		unset($input['tues_isClosed']);
		}
		else{
			$reshours->tues_isClosed = 0;
		}
		if (array_key_exists('weds_isClosed', $input)) {
    		$reshours->weds_isClosed = 1;
    		unset($input['weds_isClosed']);
		}
		else{
			$reshours->weds_isClosed = 0;
		}
		if (array_key_exists('thurs_isClosed', $input)) {
    		$reshours->thurs_isClosed = 1;
    		unset($input['thurs_isClosed']);
		}
		else{
			$reshours->thurs_isClosed = 0;
		}
		if (array_key_exists('fri_isClosed', $input)) {
    		$reshours->fri_isClosed = 1;
    		unset($input['fri_isClosed']);
		}
		else{
			$reshours->fri_isClosed = 0;
		}
		if (array_key_exists('sat_isClosed', $input)) {
    		$reshours->sat_isClosed = 1;
    		unset($input['sat_isClosed']);
		}
		else{
			$reshours->sat_isClosed = 0;
		}
		if (array_key_exists('sun_isClosed', $input)) {
    		$reshours->sun_isClosed = 1;
    		unset($input['sun_isClosed']);
		}
		else{
			$reshours->sun_isClosed = 0;
		}


		unset($input['_token']); // remove csrf token before updating with all input
		foreach($input as $in_time){
			if(date('H:i:s', strtotime($in_time)) == "00:00:00"
				and $in_time != "12:00 AM" or !preg_match("/:/", $in_time)){
				return Redirect::back()
			->withErrors('Ensure that open/close times are in "00:00 AM/PM" format')
			->withInput();
			}
		}

		$reshours->update($input);
		return Redirect::to('restaurant');
	}


	public function postManageAboutUs(){
		$restaurant = Restaurant::find(Session::get('role_id'));
		
		if(Input::hasFile('img')){
			$file = Input::file('img');
			$fileName = 'logo';
			$filePath = base_path() . '/public/imgs/rest_imgs/'.Session::get('role_id');
			$file = $file->move($filePath, $fileName);
			$restaurant->logo_path = 'imgs/rest_imgs/'.Session::get('role_id').'/'.$fileName;
		}

		if(Input::get('is_deliver') == 'on'){
			$restaurant->is_deliver = true;
		}
		else{
			$restaurant->is_deliver = false;
		}

		$restaurant->about_us = Input::get('about_us');
		$restaurant->save();
		return Redirect::to('restaurant');
	}

	public function postManageCuisines(){
		$restaurant = Restaurant::find(Session::get('role_id'));
		$restaurant->clearCuisines();

		$input = Input::all();

		unset($input['_token']);

		$chosen_ids  = array_values($input);
		foreach($chosen_ids as $id){
			$restaurant->addCuisine($id);
		}
		$restaurant->save();
		return Redirect::to('restaurant');
	}

	public function postPassword(){

		$validator = Validator::make(Input::all(), User::$edit_pwd_rules);
		if($validator->passes()){
			$user = User::find(Session::get('user_id'));

			if (Hash::check(Input::get('old_password'), $user->password))
			{
				$user->password = Hash::make(Input::get('password'));
				$user->save();
				
				return Redirect::to('restaurant');
			}
			else{
				return Redirect::back()
				->withErrors('Incorrect Password');
			}
		}
		else{
			return Redirect::back()
				->withErrors($validator);
		}

	}


	public function putProfile() {
	}

	public function getAddDish() {
		return View::make('restaurants.add-dish')
			->with('restaurant', Restaurant::find(Session::get('role_id')));
	}

	/*
	*	post from add-dishes
	*   I change Input::get('res_id') into Session::get('role_id') -- stephen
	*/
	public function postDishes() {
		$dish = new Dish;
		$dish->res_id = Session::get('role_id');
		$dish->save(); // must save first to be given dish_id;
		$dish_pic_path = 'imgs/rest_imgs/default.jpg';


		if (Input::hasFile('img')){
			$file = Input::file('img');
			$fileName = $dish->dish_id.'.'.$file->getClientOriginalExtension();
			$filePath = base_path() . '/public/imgs/rest_imgs/'.Session::get('role_id');
			$file = $file->move($filePath, $fileName);
			// given an image, change to new path
			$dish_pic_path = 'imgs/rest_imgs/'.Session::get('role_id').'/'.$fileName;
		}

		$validator = Validator::make(Input::all(), Dish::$rules);
		if ($validator->passes())
		{
			$dish->res_id = Session::get('role_id');
			$dish->dish_name = Input::get('dish_name');
			$dish->dish_price = Input::get('dish_price');
			$dish->dish_description = Input::get('dish_description');
			$dish->dish_pic_path = $dish_pic_path;
			$dish->save();
			return Redirect::to('restaurant');
		} else
		{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function getDetail($id) 
	{
//		return "hi";
//		return Session::all();
		$restaurant = Restaurant::find($id);
//		if ($restaurant){
		return View::make('restaurants.detail')
			->with('restaurant', $restaurant)
			->with('dishes', $restaurant->dishes)
			->with('reshours', $restaurant->restaurantHours())
			->with('googleAPIKey', 'AIzaSyB0VBlkHxOVIQm33CybkivJ3FmvwQVQmSk');
//		}
//		else
//			App::abort(404);
	}

	/*
		Called from restaurants/manage-dishes.blade.php.
		Deleting the dish will set the 'serving' column to false
		as to not display it on the restaurant's gallery.
		P.S. filter yet.
	*/
	public function postDeleteDish(){
	
		$dish_id = Input::get('dish_id');

		if(Input::get('archive') == true){
			DB::statement('update dishes set serving=0 where dish_id = ?', array($dish_id));
		}
		else{
			DB::statement('update dishes set serving=1 where dish_id = ?', array($dish_id));
		}
		return Redirect::to('restaurant/manage-dishes');

	}

	// filter yet
	public function getEditDish(){
		$dish = Dish::find(Input::get('dish_id'));
		return View::make('restaurants/edit-dish')
			->with('dish', $dish);
	}

	// filter yet
	public function postEditDish(){

		$res_id = Session::get('role_id');
		$dish = Dish::find(Input::get('dish_id'));

		/*
		 * If the edit submits a new picture then replace the 
		 * old picture (no name change). 
		 */
		if(Input::hasFile('img')){
			$file = Input::file('img');
    		$filePath = base_path() . '/public/imgs/rest_imgs/'.$res_id;
    		$fileName = $dish->dish_id.'.'.$file->getClientOriginalExtension();	
			$file = $file->move($filePath, $fileName); // replace old image.
			$dish->dish_pic_path = 'imgs/rest_imgs/'.$res_id.'/'.$fileName;
		}


		$rules = Dish::$rules;
		array_shift($rules); //remove res_id requirement
		$validator = Validator::make(Input::all(), $rules);
		if($validator->passes()){
			$dish->dish_name = Input::get('dish_name');
			$dish->dish_price = Input::get('dish_price');
			$dish->dish_description = Input::get('dish_description');
			$dish->save();
			return Redirect::to('restaurant');
		}
		else{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}

	}

	public function getOrders(){	
		$restaurant = Restaurant::find(Session::get('role_id'));
		$tax = Tax::getTax();
		$orders = Order::where(array('res_id' => $restaurant->res_id))->get(); 
		return View::make('restaurants.orders', array(
			'restaurant'=>$restaurant, 
			'orders'=>$orders,
			'tax'=>$tax));
	
	}

	public function postSearch()
	{
		// still wonder why have to add $ here
		if ( Input::get('cuisine-id') == 0 )
		{
			return $this->search_without_cuisine_id(Restaurant::where('legitimate', '=', true)
				->orderBy('score', 'desc')->get());
		} else
		{
			return $this->search_with_cuisine_id();
		}
	}
	private function search_with_cuisine_id()
	{
		$restaurants = array();
		foreach (Restaurant::where('legitimate', '=', true)->orderBy('score', 'desc')->get() as $restaurant)
		{
			$match = false;
			foreach ($restaurant->cuisines as $cuisine)
			{
				$match = $match? $match: $cuisine->cuisine_id==Input::get('cuisine-id');
			}
			if ($match == false)
			{
				continue;
			}
			array_push( $restaurants, $restaurant);
		}
		return $this->search_without_cuisine_id($restaurants);
	}
	private function search_without_cuisine_id($restaurants)
	{
		$cuisines = array('All Cuisines', 0);
		foreach (Cuisine::all() as $cuisine)
		{
			$cuisines[$cuisine->cuisine_id] = $cuisine->cuisine_name;
		}
		
		if ( preg_match('/^\s*$/', Input::get('restaurant-name')) ) 
		{
			return View::make('index')
				->with('restaurants', $restaurants)
				->with('cuisines', $cuisines);
		}
		$restaurant_ret = array();
		foreach ($restaurants as $restaurant)
		{
			$match = false;
			foreach (preg_split('/\s+/', Input::get('restaurant-name')) as $item)
			{
				$match = $match? $match: substr_count(strtoupper($restaurant->res_name), strtoupper($item))>0;
			}
			if ($match)
			{
				array_push( $restaurant_ret, $restaurant );
			}
		}
		return View::make('index')
			->with('restaurants', $restaurant_ret)
			->with('cuisines', $cuisines);
	}

	// filter yet
	public function postComplete(){
			// restaurant send order
			$order = Order::find(Input::get('id'));
			// the following syntax seems wrong with converting string
			//$orders = Order::where(array('cust_id' => $customer->cust_id))->get(); 
			//$order = Order::where('order_id' , '=' , Input::get('id'));
			$order->is_sent = 1;
			$order->save();
			return Redirect::to('restaurant/orders');
	}

	public function getOrderStatistics(){
		$restaurant = Restaurant::find(Session::get('role_id'));
		return View::make('restaurants.order-statistics')
			->with('restaurant', $restaurant);
	}
}
