q<?php

class CustomerController extends BaseController 
{
	protected $layout = 'layouts.main';

	public function __construct()
	{
		$this->beforeFilter('customer');
		$this->beforeFilter('customer_get_edit_address', ['only' => 'getEditAddress']);		
		$this->beforeFilter('customer_put_address', ['only'=>'putAddress']);
		$this->beforeFilter('customer_post_address', ['only'=>'postAddress']);
		$this->beforeFilter('customer_post_complete', ['only'=>'postComplete']);
	}

	public function getIndex()
	{
		return $this->getManagement();
	}

	public function getManagement()
	{
		return View::make('customers.management') 
			->with('customer', Customer::find(Session::get('role_id')))
			->with('orders', Order::where('cust_id', '=', Session::get('role_id'))->take(10)->get())
			->with('user', User::find(Session::get('user_id')));
	}

	public function getEditProfile()
	{
		return View::make('customers.edit-profile')
			->with('customer', Customer::find(Session::get('role_id')));
	}

	public function putProfile() 
	{
		$validator = Validator::make(Input::all(), Customer::$rules);

		if ($validator->passes())
		{
			// note that input must have cust_id here 
			$customer = Customer::find(Session::get('role_id')); 
			$customer->first_name = Input::get('first_name');
			$customer->last_name = Input::get('last_name');
			$customer->cust_tel = Input::get('cust_tel');
			$customer->save();
			return Redirect::to('/customer/management');
		} else
		{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function getManageSecurity(){
		$this->layout->content = View::make('users.manage-security')
			->with('user', User::find(Session::get('user_id')));
	}

	public function getAddAddress(){
		if (Request::ajax()){
			$this->layout = "layouts.ajax";
		}

		$this->layout->content = 
			View::make('customers.add-address')
				->with('customer', Customer::find(Session::get('role_id')));
	}

	// filter yet.
	public function postAddress(){
		$validator = Validator::make(Input::all(), CustAddr::$rules);
		if ($validator->passes())
		{
			$cust_addr = new CustAddr;
			$cust_addr->cust_id = Input::get('cust_id');
			$cust_addr->country = Input::get('country');
			$cust_addr->province = Input::get('province');
			$cust_addr->city = Input::get('city');
			$cust_addr->street = Input::get('street');

			if(!Input::has('apt_num')){
				$cust_addr->apt_num = 'null';
			}
			$cust_addr->apt_num = Input::get('apt_num');
			$cust_addr->postal_code = Input::get('postal_code');
			$cust_addr->note = Input::get('note');
			$cust_addr->save();
			return Redirect::to('/customer/management');
		} else
		{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	// filter yet.
	public function putAddress(){
		$validator = Validator::make(Input::all(), CustAddr::$rules_edit);
		if ($validator->passes())
		{
			$cust_addr = CustAddr::find(Input::get('cust_addr_id'));
			$cust_addr->country = Input::get('country');
			$cust_addr->province = Input::get('province');
			$cust_addr->city = Input::get('city');
			$cust_addr->street = Input::get('street');
			if(!Input::has('apt_num')){
				$cust_addr->apt_num = 'null';
			}
			$cust_addr->apt_num = Input::get('apt_num');
			$cust_addr->postal_code = Input::get('postal_code');
			$cust_addr->note = Input::get('note');
			$cust_addr->save();
			return Redirect::to('/customer/management');
		} else
		{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	// filter yet. 
	public function getEditAddress($addr_id){
		return View::make('customers.edit-address')
			->with('address', CustAddr::find($addr_id)); // cust_addr? does that work?
	}

	public function getOrders()
	{
		$customer = Customer::find(Session::get('role_id'));
		$orders = Order::where(array('cust_id' => $customer->cust_id))->get(); 		
		$tax = Tax::getTax();
		return View::make('customers.orders', array(
			'customer'=>$customer,
			'orders'=>$orders,
			'tax'=>$tax,
		));
	}

	// filter yet.
	public function postComplete() {
			$order = Order::find(Input::get('id'));
			// the following syntax seems wrong with converting string
			//$orders = Order::where(array('cust_id' => $customer->cust_id))->get(); 
			//$order = Order::where('order_id' , '=' , Input::get('id'));
			$order->is_sent = 1;
			$order->is_fulfilled = 1;
			$order->save();
			return Redirect::to('customer/orders');
	}

	public function deleteCustomerAddress() {
		$cust_addr_id = Input::get('cust_addr_id');
		$cust_addr = CustAddr::find(Input::get('cust_addr_id'));
		$cust_addr->hidden = True;
		$cust_addr->save();
		return Redirect::back();
	}
}

/*	public function putEditSecurity(){
		$validator = Validator::make(Input::all(), User::$edit_rules);

		if ($validator->passes()){
			$user = User::where('cust_id', '=', Session::get('role_id'))->first();
			return $customer->email;
		}

		return "hello word";
	}*/