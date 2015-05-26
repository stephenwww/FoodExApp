<?php
 
class OrderTableSeeder extends Seeder 
{
 
    /***************************
    * Orders
    *---------------------------
    * order_id
    * cust_id
    * res_id
    * cust_addr_id
    * order_time
    * order_price
    * is_fulfilled
    * is_sent
    ****************************/

    public function run()
    {
    	// must be call after seeding for userTable

    	$user1 = User::where('email', '=', 'cust_1@sfu.ca')->first();
        $user2 = User::where('email', '=', 'cust_2@sfu.ca')->first();

    	$user3 = User::where('email', '=', 'rest_1@sfu.ca')->first();
        $user4 = User::where('email', '=', 'rest_2@sfu.ca')->first();

    	$customer1 = Customer::where(array('user_id' => $user1->user_id))->first();
        $customer2 = Customer::where(array('user_id' => $user2->user_id))->first();

    	$restaurant1 = Restaurant::where(array('user_id' => $user3->user_id))->first();
        $restaurant2 = Restaurant::where(array('user_id' => $user4->user_id))->first();

        $addr1 = CustAddr::where(array('cust_id' => $customer1->cust_id))->first();
        $addr2 = CustAddr::where(array('cust_id' => $customer2->cust_id))->first();


//////////////////////////////////////////////////////////////////////////
/* orders for display */

        // order 1-3, not sent, not received
        for( $j = 1 ; $j <= 3 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = DB::raw('CURRENT_TIMESTAMP');
            $order->order_price = 0;
            $order->is_fulfilled = 0;
            $order->is_sent = 0;
            $order->save();
        }

        // order 4-5, sent, not received
        for( $j = 1 ; $j <= 2 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer2->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr2->cust_addr_id;
            $order->order_time = DB::raw('CURRENT_TIMESTAMP');
            $order->order_price = 0;
            $order->is_fulfilled = 0;
            $order->is_sent = 1;
            $order->save();
        }

        // order 6-8, sent, received
        for( $j = 1 ; $j <= 3 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('yesterday');
            $order->order_price = 33.99;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        // order 9-10 sent, received 
        for( $j = 1 ; $j <= 2 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer2->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr2->cust_addr_id;
            $order->order_time = new DateTime('yesterday');
            $order->order_price = 30;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }


/*  orders for charts
//////////////////////////////////////////////////////////////
*/

        for( $j = 1 ; $j <= 3 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('yesterday');
            $order->order_price = 23.32;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }


        for( $j = 1 ; $j <= 10 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-1 days');
            $order->order_price = 10;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 3 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-2 days');
            $order->order_price = 230;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 4 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-3 days');
            $order->order_price = 12;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }
        for( $j = 1 ; $j <= 3 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-4 days');
            $order->order_price = 21;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 4 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-3 weeks');
            $order->order_price = 123;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 7 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-2 weeks');
            $order->order_price = 57;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 11 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-5 days');
            $order->order_price = 92;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 7 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-6 days');
            $order->order_price = 299;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }

        for( $j = 1 ; $j <= 4 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer1->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr1->cust_addr_id;
            $order->order_time = new DateTime('-7 days');
            $order->order_price = 12;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }
        
        for( $j = 1 ; $j <= 2 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer2->cust_id;
            $order->res_id = $restaurant2->res_id;
            $order->cust_addr_id = $addr2->cust_addr_id;
            $order->order_time = new DateTime('-7 days');
            $order->order_price = 23;
            $order->is_fulfilled = 0;
            $order->is_sent = 1;
            $order->save();
        }

        

        for( $j = 1 ; $j <= 2 ; $j++ )
        {
            $order = new Order;
            $order->cust_id = $customer2->cust_id;
            $order->res_id = $restaurant1->res_id;
            $order->cust_addr_id = $addr2->cust_addr_id;
            $order->order_time = new DateTime('yesterday');
            $order->order_price = 232;
            $order->is_fulfilled = 1;
            $order->is_sent = 1;
            $order->save();
        }


  }
}