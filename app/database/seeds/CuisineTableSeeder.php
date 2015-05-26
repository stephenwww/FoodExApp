<?php
 
class CuisineTableSeeder extends Seeder 
{
 
    public function run()
    {
    	$cuisine = Cuisine::create(array(
	  	 	'cuisine_name' => 'Chinese'
		));

		$cuisine = Cuisine::create(array(
	  	 	'cuisine_name' => 'Japanese'
		));

		$cuisine = Cuisine::create(array(
	  	 	'cuisine_name' => 'French'
		));

		$cuisine = Cuisine::create(array(
	  	 	'cuisine_name' => 'Italian'
		));

  }
 
}
