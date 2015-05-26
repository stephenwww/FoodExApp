<?php

class Customer extends Eloquent
{
/*-------------+------------------+------+-----+---------+----------------+
 | Field       | Type             | Null | Key | Default | Extra          |
 +-------------+------------------+------+-----+---------+----------------+
 | cust_id     | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
 | user_id     | int(10) unsigned | NO   | MUL | NULL    |                |
 | first_name  | varchar(255)     | NO   |     | NULL    |                |
 | last_name   | varchar(255)     | NO   |     | NULL    |                |
 | cust_tel    | varchar(255)     | NO   |     | NULL    |                |
 | cust_points | varchar(255)     | NO   |     | NULL    |                |
 +-------------+------------------+------+-----+---------+----------------*/

	public static $rules = array(
	    'first_name'=>'required|alpha|min:2',
	    'last_name'=>'required|alpha|min:2'
	);

	protected $table = 'customers';
	protected $primaryKey = 'cust_id';
	protected $guarded = array('cust_id', 'user_id');
	public $timestamps = false;

	
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	
	/*
	*	The addresses that this customer has
	*/
	public function custAddrs()
	{
		return $this->hasMany('CustAddr', 'cust_id');
	}

	/*
	*	Reviews made by this customer
	*/
	public function review()
	{
		return $this->hasMany('Review', 'cust_id');
	}

	/*
	*	Orders made by the customer
	*/
	public function order()
	{
		return $this->hasMany('Order', 'cust_id');
	}

	/*
	*	The restaurants that this customer has ordered from.
	*/
	public function restaurants()
	{
		return $this->hasManyThrough('Restaurant', 'Order', 'cust_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}