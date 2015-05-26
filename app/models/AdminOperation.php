<?php

class AdminOperation extends Eloquent
{
	/***************************
	* admins
	*---------------------------
    * op_id
    * admin_id
    * res_id
    * op_type
    * op_time    
	****************************/	
	public $timestamps = false;
	protected $table = 'admin_operations';
	protected $primaryKey = 'op_id';
}
?>