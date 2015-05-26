<?php

class Order extends Eloquent{

	/***************************
	* Orders
	*---------------------------
    * order_id
    * cust_id
    * res_id
    * cust_addr_id
    * order_time
    * order_price
    * is_fulfilled
    * order_pay_way
	****************************/

	protected $table = 'orders';
	protected $primaryKey = 'order_id';
	protected $guarded = array('order_id');
	public $timestamps = false;
	public static $rules = array(
//		'cust_addr_id' => 'required',
		'service_type' => 'required'
	);
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	
	public function customer(){
		return $this->belongsTo('Customer', 'cust_id');
	}

	public function review(){
		return $this->hasOne('Review', 'order_id');
	}

	public function restaurant(){
		return $this->belongsTo('Restaurant', 'res_id');
	}

	public function custaddr(){
		// return $this->hasOne('Phone', 'foreign_key', 'local_key');
		return $this->hasOne('CustAddr','cust_addr_id', 'cust_addr_id');
	}

	public function orderDishes(){
		return $this->hasMany('OrderDish', 'order_id');
	}


}