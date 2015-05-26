<?php

class ResCuisine extends Eloquent
{
	/***************************
	* Restaurant_Cuisines
	*---------------------------
    * res_cuisine_id
	* res_id
	* cuisine_id
	****************************/
	public $timestamps = false;
	protected $table = 'restaurant_cuisines';
	protected $primaryKey = 'res_cuisine_id';
	protected $guarded = array('res_cuisine_id');


	// note that the contructor func for model is:
	// __construct(array $attributes) instread of what we use before
	// thus I delete the wrong one below, and add unique constraint in initDB
/*	wrong function	
	public function __constructor()
	{
		$table->unique(array('res_id', 'cuisine_id'));
	}*/
}