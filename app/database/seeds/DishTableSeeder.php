<?php

class DishTableSeeder extends Seeder 
{
	/***************************
	* Dishes
	*---------------------------
	* dish_id
	* res_id
	* dish_name
	* dish_price
	* dish_pic_path
	****************************/
    public function run()
    {
    	// note must be run after seeding cuisine and restaurant 
    	Dish::create(array(
    		'dish_id' => 1,
    		'res_id' => 1,
    		'dish_name' => 'Fish and Caution',
    		'dish_price' => 20,
    		'dish_pic_path' => 'imgs/dish_imgs/fish-and-caution.jpg',
    	));

    	Dish::create(array(
    		'dish_id' => 2,
    		'res_id' => 1,
    		'dish_name' => 'Green Tea Roast',
    		'dish_price' => 16,
    		'dish_pic_path' => 'imgs/dish_imgs/green-tea-roast.jpg',
    	));

    	Dish::create(array(
    		'dish_id' => 3,
    		'res_id' => 1,
    		'dish_name' => 'Bread and Caution',
    		'dish_price' => 9,
    		'dish_pic_path' => 'imgs/dish_imgs/bread-and-caution.jpg',
    	));

    	Dish::create(array(
    		'dish_id' => 4,
    		'res_id' => 1,
    		'dish_name' => 'Roasted Chicken',
    		'dish_price' => 18,
    		'dish_pic_path' => 'imgs/dish_imgs/roasted-chicken.jpg',
    	));

    	Dish::create(array(
    		'dish_id' => 5,
    		'res_id' => 1,
    		'dish_name' => 'Beef and Caution',
    		'dish_price' => 18,
    		'dish_pic_path' => 'imgs/dish_imgs/beef-and-caution.jpg',
    	));

    	Dish::create(array(
    		'dish_id' => 6,
    		'res_id' => 1,
    		'dish_name' => 'Preserved Egg Tofu',
    		'dish_price' => 6,
    		'dish_pic_path' => 'imgs/dish_imgs/preserved-egg-tofu.jpg',
    	));

    	Dish::create(array(
    		'dish_id' => 7,
    		'res_id' => 1,
    		'dish_name' => 'Stew Eggplant',
    		'dish_price' => 9,
    		'dish_pic_path' => 'imgs/dish_imgs/stew-eggplant.jpg',
    	));


  }
 
}
