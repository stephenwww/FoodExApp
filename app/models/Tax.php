<?php

class Tax extends Eloquent
{

	/* There is one and only one tax record with tax_id 1*/
	/***************************
	* Tax
	*---------------------------
    * tax_id
    * tax_percentage   
	****************************/	
	public $timestamps = false;
	protected $primaryKey = 'tax_id';

	public static function getTax(){
		$exist = DB::select('SELECT * from tax');
		if(empty($exist)){
			DB::statement('INSERT INTO tax(tax_percentage) VALUES(5)');
		}
		$tax_object = DB::select('select tax_percentage from tax where tax_id=1');
		return $tax_object[0]->tax_percentage;
	}
}

?>