<?php
 
class OrderDishTableSeeder extends Seeder 
{
	/***************************
	* Order_Dishes
	*---------------------------
	* order_dish_id
	* order_id
	* dish_id
	* dish_amount
	****************************/
 
    public function run()
    {	
		
		for( $j = 1 ; $j <= 10 ; $j++ )
        {
        	$order = Order::where('order_id', '=', $j)->first();
        	$sum = 0;
        	for( $i = 1 ; $i <= 5 ; $i++ )
	        {
	        	$dish = Dish::where('dish_id', '=', $i)->first();
				$order_dish = new OrderDish;
				$order_dish->order_id = $j;
				$order_dish->dish_id = $i;
				$order_dish->dish_amount = rand(1,3);
				$order_dish->save();
				$sum += ($order_dish->dish_amount) * ($dish->dish_price);
			}
        	$order->update(array('order_price'=>$sum));
		}
		
  	}
}