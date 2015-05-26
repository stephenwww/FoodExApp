<?php

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class CustomerFilter 
{
	public function filter()
	{
//		return "customer.filter";
		if (Session::has('role') == false 
			|| Session::get('role') != constant("CUSTOMER"))
		{
			return Redirect::to('user/login')
				->withErrors("You are not customer now. You might want to login in as customer.");
		}
//		return "customer.filter.done";
	}

	public function post_address()
	{
		if (Input::get('cust_id') != Session::get('role_id'))
		{
			return "You cannot upload other people's address.";
		}
	}

	public function put_address()
	{
		try 
		{
			if (CustAddr::findOrFail(Input::get('cust_addr_id'))->cust_id != Session::get('role_id'))
			{
				return "You cannot edit other people's address";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such address!', 404);				
		}
	}

	public function get_edit_address()
	{
		try 
		{
			if ( CustAddr::findOrFail( Request::segment(3) )->cust_id != Session::get('role_id') )
			{
				return "You cannot see or edit other people's address";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such address!', 404);				
		}		
	}

	public function post_complete()
	{
		try
		{
			if ( Order::findOrFail(Input::get('id'))->cust_id != Session::get('role_id') )
			{
				return "You cannot operate on other people's order.";
			}
		} catch (ModelNotFoundException $e)
		{
			return Response::make('There is no such order!', 404);				
		}
	}
}

?>