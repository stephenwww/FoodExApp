<?php

class OrderDish extends Eloquent{

	/***************************
	* Order_Dishes
	*---------------------------
	* order_dish_id
	* order_id
	* dish_id
	* dish_amount
	****************************/

	protected $table = 'order_dishes';
	protected $primaryKey = 'order_dish_id';
	protected $guarded = array('order_dish_id');
	public $timestamps = false;
	
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	public function order(){
		return $this->belongsTo('Order', 'order_id');
	}

	public function dish(){
		return $this->belongsTo('Dish', 'dish_id');
	}


}