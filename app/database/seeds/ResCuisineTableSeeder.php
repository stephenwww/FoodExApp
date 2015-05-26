<?php
 
class ResCuisineTableSeeder extends Seeder 
{
 
    public function run()
    {
    	// note must be run after seeding cuisine and restaurant 
    	$res_cuisine = ResCuisine::create(array(
	  	 	'res_id' => 1,
	  		'cuisine_id' => 1,
		));

		$res_cuisine = ResCuisine::create(array(
	  	 	'res_id' => 1,
	  		'cuisine_id' => 2,
		));

		$res_cuisine = ResCuisine::create(array(
	  	 	'res_id' => 2,
	  		'cuisine_id' => 3,
		));

		$res_cuisine = ResCuisine::create(array(
	  	 	'res_id' => 3,
	  		'cuisine_id' => 3,
		));

		$res_cuisine = ResCuisine::create(array(
	  	 	'res_id' => 4,
	  		'cuisine_id' => 4,
		));

		$res_cuisine = ResCuisine::create(array(
	  	 	'res_id' => 5,
	  		'cuisine_id' => 1,
		));

  }
 
}
