<?php
class AdminFilter
{
	public function filter()
	{
		if (Session::has('role') == false
			|| Session::get('role') != constant("ADMIN"))
		{
			return Redirect::to('user/login');
		}		
	}	
}
?>