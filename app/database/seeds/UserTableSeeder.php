<?php
 
require_once(app_path().'/includes/macro.php');

class UserTableSeeder extends Seeder 
{
 
    public function run()
    {
        // 5 legitimate, 5 illegitimate restaurant
		for( $i = 1 ; $i <= 25 ; $i++ )
        {
        	$user = new User;
        	$user->username = 'rest_'.$i;
        	$user->password = Hash::make('123456');
        	$user->email = 'rest_'.$i.'@sfu.ca';
        	$user->role = constant("RESTAURANT");
            $user->is_confirmed_email = true;
        	$user->save(); 
        }

         for( $i = 1 ; $i <= 5 ; $i++ )
        {
        	$user = new User;
        	$user->username = 'cust_'.$i;
        	$user->password = Hash::make('123456');
        	$user->email = 'cust_'.$i.'@sfu.ca';
        	$user->role = constant("CUSTOMER");
            $user->is_confirmed_email = true;
        	$user->save(); 
        }

        for( $i = 1 ; $i <= 5 ; $i++ )
        {
            $user = new User;
            $user->username = 'admin_'.$i;
            $user->password = Hash::make('123456');
            $user->email = 'admin_'.$i.'@sfu.ca';
            $user->role = constant("ADMIN");
            $user->is_confirmed_email = true;
            $user->save(); 
        }
/*
        $user = new User;
            $user->username = 'jeremy_ni';
            $user->password = Hash::make('123456');
            $user->email = 'nizeyu123@gmail.com';
            $user->role = constant("CUSTOMER");
            $user->save(); 
            */
  }
 
}
