<?php

class Dish extends Eloquent
{
   /*------------------+------------------+------+-----+---------+----------------+
	| Field            | Type             | Null | Key | Default | Extra          |
	+------------------+------------------+------+-----+---------+----------------+
	| dish_id          | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
	| res_id           | int(10) unsigned | NO   | MUL | NULL    |                |
	| dish_name        | varchar(255)     | NO   |     | NULL    |                |
	| dish_price       | float(8,2)       | NO   |     | NULL    |                |
	| dish_description | varchar(255)     | NO   |     | NULL    |                |
	| dish_pic_path    | varchar(255)     | NO   |     | NULL    |                |
	+------------------+------------------+------+-----+---------+----------------*/

	protected $table = 'dishes';
	protected $primaryKey = 'dish_id';
	protected $guarded = array('dish_id');
	public $timestamps = false;

	public static $rules = array(
	    'res_id'=>'required',
	    'dish_name'=>'required|min:2|max:26',
	    'dish_price'=>'required|regex:/^\d*.\d\d$/',
	    'dish_description' => 'max:255'   
	);
	
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	
	public function restaurant(){
		return $this->belongsTo('Restaurant');
	}

	public function order_dish(){
		return $this->hasMany('OrderDish');
	}


}