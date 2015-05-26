<?php

class CustAddr extends Eloquent
{
	/***************************
	* Customer_Addresses
	*---------------------------
	* cust_addr_id
	* cust_id
	* country
	* province
	* city
	* street
	* apt_num
	* postal_code
	* note
	****************************/

	protected $table = 'customer_addresses';
	protected $primaryKey = 'cust_addr_id';
	protected $guarded = array('cust_addr_id', 'cust_id');
	public $timestamps = false;
	
	public static $rules = array(
	    'cust_id'=>'required|exists:customers',
	    'country'=>'alpha|min:2',
	    'province'=>'alpha|min:2',
	    'city'=>'alpha_num|required',
	    'street'=>'required',
	    'apt_num'=>'alpha_num|min:1',
	    'postal_code'=>'alpha_num|required|between:6,6'
	);

	public static $rules_edit = array(
		'country'=>'alpha|min:2',
	    'province'=>'alpha|min:2',
	    'city'=>'alpha_num|required',
	    'street'=>'required',
	    'apt_num'=>'alpha_num|min:1',
	    'postal_code'=>'alpha_num|required|between:6,6'
	);
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	
	public function customer()
	{
		return $this->belongsTo('Customer', 'cust_id');
	}
/*
	public function order(){
		return $this->belongsTo('Order','cust_addr_id');
	}
	*/
}