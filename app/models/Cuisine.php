<?php

class Cuisine extends Eloquent
{
	/***************************
	* Cuisines
	*---------------------------
    * cuisine_id
    * cuisine_name
	****************************/

	protected $table = 'cuisines';
	protected $primaryKey = 'cuisine_id';
	protected $guarded = array('cuisine_id');
	public $timestamps = false;

	
	/*--------------------------------------------------------------------------
	| Relations: refer to http://laravel.com/docs/eloquent#dynamic-properties  |
	|--------------------------------------------------------------------------*/
	
	
	public function restaurant(){
		return $this->belongsToMany('Restaurant');
	}

}