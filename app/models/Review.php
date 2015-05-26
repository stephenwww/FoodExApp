<?php

class Review extends Eloquent{

	/***************************
	* Reviews
	*---------------------------
	* review_id
	* res_id
	* order_id
	* cust_id
	* review_content
	* review_score
	****************************/

	protected $table = 'reviews';
	protected $primaryKey = 'review_id';
	protected $guarded = array('review_id');
	public $timestamps = false;
	
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	

	public function customer(){
		return $this->belongsTo('Customer', 'cust_id');
	}

	public function restaurant(){
		return $this->belongsTo('Restaurant', 'res_id');
	}

	public function order(){
		return $this->belongsTo('Order', 'order_id');
	}
}