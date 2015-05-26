<?php
class RestaurantTableSeeder extends Seeder 
{
/*----------------+------------------+------+-----+---------------------+----------------+
 | Field          | Type             | Null | Key | Default             | Extra          |
 +----------------+------------------+------+-----+---------------------+----------------+
 | res_id         | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 | user_id        | int(10) unsigned | NO   | MUL | NULL                |                |
 | res_name       | varchar(255)     | NO   |     | NULL                |                |
 | res_email      | varchar(255)     | NO   |     | NULL                |                |
 | res_tel        | varchar(255)     | NO   |     | NULL                |                |
 | res_country    | varchar(255)     | NO   |     | NULL                |                |
 | res_province   | varchar(255)     | NO   |     | NULL                |                |
 | res_city       | varchar(255)     | NO   |     | NULL                |                |
 | res_street     | varchar(255)     | NO   |     | NULL                |                |
 | res_postalcode | varchar(255)     | NO   |     | NULL                |                |
 | about_us       | varchar(255)     | NO   |     | NULL                |                |
 | is_deliver     | tinyint(1)       | NO   |     | 1                   |                |
 | is_available   | tinyint(1)       | NO   |     | 1                   |                |
 | logo_path      | varchar(255)     | NO   |     | NULL                |                |
 | open_time      | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 | close_time     | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 | score          | float(8,2)       | NO   |     | NULL                |                |
 +----------------+------------------+------+-----+---------------------+----------------*/

    public function run()
    {
        $res_city_array = array('burnaby', 'vancouver', 'richmond');
        $res_street_array = array('street1', 'street2', 'street3', 'street4', 'street5');
    	$res_postalcode_array = array('V5A2R3','V9F3H6','V8SF9G');

        for( $i = 1 ; $i <= 20 ; $i++ )
        {
            $user = User::where('email', '=', 'rest_'.$i.'@sfu.ca' )->first();
            $res = new Restaurant;
            $res->user_id = $user->user_id;
            $res->res_name = 'rest'.$i;
            $res->res_email = 'rest'.$i.'@sfu.ca';
            //tel, country, province default
            $res->res_city = $res_city_array[rand(0,2)];
            $res->res_street = $res_street_array[rand(0,4)];
            $res->score = $i<5? 5: rand(1,5);
            $res->res_postalcode = $res_postalcode_array[rand(0,2)];
            $res->legitimate = true;
            $res->about_us = 'ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US';
            $res->save();
            $reshour = new RestaurantHours;
            $reshour->res_id = $res->res_id;
            $reshour->save();
        }


        // illegitimate restaurant
        for( $i = 21 ; $i <= 25 ; $i++ )
        {
            $user = User::where('email', '=', 'rest_'.$i.'@sfu.ca' )->first();
            $res = new Restaurant;
            $res->user_id = $user->user_id;
            $res->res_name = 'rest'.$i;
            $res->res_email = 'rest'.$i.'@sfu.ca';
            //tel, country, province default
            $res->res_city = $res_city_array[rand(0,2)];
            $res->res_street = $res_street_array[rand(0,4)];
            $res->score = rand(1,5);
            $res->res_postalcode = $res_postalcode_array[rand(0,2)];
            $res->legitimate = false;
            $res->about_us = 'ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US ABOUT US';
            $res->save();
            $reshour = new RestaurantHours;
            $reshour->res_id = $res->res_id;
            $reshour->save();
        }
  }
 
}
