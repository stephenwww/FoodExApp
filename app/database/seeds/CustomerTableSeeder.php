<?php
 
class CustomerTableSeeder extends Seeder 
{
 /*-------------+------------------+------+-----+---------+----------------+
 | Field       | Type             | Null | Key | Default | Extra          |
 +-------------+------------------+------+-----+---------+----------------+
 | cust_id     | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
 | user_id     | int(10) unsigned | NO   | MUL | NULL    |                |
 | first_name  | varchar(255)     | NO   |     | NULL    |                |
 | last_name   | varchar(255)     | NO   |     | NULL    |                |
 | cust_tel    | varchar(255)     | NO   |     | NULL    |                |
 | cust_points | varchar(255)     | NO   |     | NULL    |                |
 +-------------+------------------+------+-----+---------+----------------*/
    public function run()
    {
    	// must be call after seeding for userTable
    	$first_name_array = array('Tom', 'Bob', 'Nick');
    	$last_name_array = array('Ni', 'Lin', 'Tang');
    	for( $i = 1 ; $i <= 5 ; $i++ )
        {
            $user = User::where('email', '=', 'cust_'.$i.'@sfu.ca' )->first();
            $cust = new Customer;
            $cust->user_id = $user->user_id;
            $cust->first_name = $first_name_array[rand(0,2)];
            $cust->last_name = $last_name_array[rand(0,2)];
            $cust->cust_points = rand(0,10);
//            $cust->is_confirmed_email = true;
            $cust->save();
        }
/*
        $user = User::where('email', '=', 'nizeyu123@gmail.com' )->first();
            $cust = new Customer;
            $cust->user_id = $user->user_id;
            $cust->first_name = 'Jeremy';
            $cust->last_name = 'Ni';
            $cust->cust_points = rand(0,10);
            $cust->save();
            */
  }
 
}
