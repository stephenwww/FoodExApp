<?php
class ReviewTableSeeder extends Seeder 
{
    public function run()
    {
        $order_array = Order::all();
        $content_array = array('Great Food', 'Every Expensive', 'Soso', 'Nice Environment', 'Bad Food');
        for( $i = 0 ; $i < 10 ; $i++ )
        {
            $order = $order_array[$i];
            $review = new Review;
            $review->res_id = $order->res_id;
            $review->cust_id = $order->cust_id;
            $review->order_id = $order->order_id;
            if ($order->is_fulfilled == 1)
            {
                $review->review_content = $content_array[rand(0,4)];
                $review->review_score = rand(1,5);
            }
            $review->touch();
            $review->save();
        }
  }
 
}
