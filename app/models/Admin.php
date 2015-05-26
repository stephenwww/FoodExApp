<?php

class Admin extends Eloquent
{
	/***************************
	* admins
	*---------------------------
    * admin_id
    * user_id
    * admin_name    
	****************************/	
	public $timestamps = false;
	protected $primaryKey = 'admin_id';
}

?>