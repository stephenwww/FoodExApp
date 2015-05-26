<?php

class RestaurantHours extends Eloquent
{
	public $table = 'res_hours';
	public $primaryKey = 'res_hours_id';
	public $timestamps = false;
	protected $guarded = array('res_id', 'res_hours_id');


	public function restaurant(){
		return $this->belongsTo('Restaurant');
	}

}


