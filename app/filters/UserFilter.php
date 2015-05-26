<?php
class UserFilter
{
	public function post_signup()
	{
		if (Input::get('role') != constant("CUSTOMER")
			&& Input::get('role') != constant("RESTAURANT"))
		{
			return "Hey, by no means can you signup as other roles!";
		}
	}

	// if user has already login in, they cannot get or login again only if 
	// logout first.
	public function get_post_login()
	{
		if (Session::has('role') == true)
		{
			if (Session::get('role') == constant("CUSTOMER"))
			{
				return Redirect::to('/customer');
			} else if (Session::get('role') == constant("RESTAURANT"))
			{
				return Redirect::to('/restaunrt');
			} else if (Session::get('role') == constant("ADMIN"))
			{
				return Redirect::to('/admin');
			}
		}
	}
}
?>