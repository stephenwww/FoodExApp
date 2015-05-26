<?php

class Restaurant extends Eloquent
{
/*----------------+------------------+------+-----+---------------------+----------------+
 | Field          | Type             | Null | Key | Default             | Extra          |
 +----------------+------------------+------+-----+---------------------+----------------+
 | res_id         | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 | user_id        | int(10) unsigned | NO   | MUL | NULL                |                |
 | res_name       | varchar(255)     | NO   |     | NULL                |                |
 | res_email      | varchar(255)     | NO   |     | NULL                |                |
 | res_tel        | varchar(255)     | NO   |     | NULL                |                |
 | res_country    | varchar(255)     | NO   |     | NULL                |                |
 | res_province   | varchar(255)     | NO   |     | NULL                |                |
 | res_city       | varchar(255)     | NO   |     | NULL                |                |
 | res_street     | varchar(255)     | NO   |     | NULL                |                |
 | res_postalcode | varchar(255)     | NO   |     | NULL                |                |
 | about_us       | varchar(255)     | NO   |     | NULL                |                |
 | is_deliver     | tinyint(1)       | NO   |     | 1                   |                |
 | is_available   | tinyint(1)       | NO   |     | 1                   |                |
 | logo_path      | varchar(255)     | NO   |     | NULL                |                |
 | open_time      | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 | close_time     | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 | score          | float(8,2)       | NO   |     | NULL                |                |
 +----------------+------------------+------+-----+---------------------+----------------*/

	protected $table = 'restaurants';
	protected $primaryKey = 'res_id';
	protected $guarded = array('res_id', 'user_id');
	public $timestamps = false;



   /*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	

	public function orders(){
		return $this->hasMany('Order', 'res_id');
	}

	public function dishes(){
		return $this->hasMany('Dish', 'res_id');
	}

	public function cuisines(){
		return $this->belongsToMany('Cuisine', 'restaurant_cuisines', 'res_id');
	}

	/*
	*	The reviews this restaurant has
	*/
	public function reviews(){
		return $this->hasMany('Review', 'res_id');
	}

	/*
	*	The customers that have ordered from this restaurant.
	*/
	public function customers(){
		return $this->hasManyThrough('Customer', 'Order');
	}

	public function otherCuisine(){
		/* return DB::select('select * from cuisines C where NOT EXISTS
                	(select * from restaurant_cuisines R where R.res_id=?
                		AND C.cuisine_id=R.cuisine_id', array($this->res_id));
		*/

		return DB::select('select * from cuisines C where C.cuisine_id NOT IN (select R.cuisine_id from restaurant_cuisines R where R.res_id=?)', array($this->res_id));
	}

	public function addCuisine($cuisine_id){
		return DB::statement('insert into restaurant_cuisines (res_id, cuisine_id) values (?,?)', array($this->res_id, $cuisine_id));
	}

	/*
	*	call this before addCuisine()
	*	remove all cuisines, honestly, im too lazy to ffind out how to do if else in queries.
	*/
	public function clearCuisines(){
		return DB::statement('delete from restaurant_cuisines where res_id = ?', array($this->res_id));
	}


	public function restaurantHours(){
		return RestaurantHours::find(
				DB::statement('select res_hours_id from res_hours where res_id = ?'	, array($this->res_id))
			);
	}
}