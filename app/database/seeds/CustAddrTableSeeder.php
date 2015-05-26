<?php
 
class CustAddrTableSeeder extends Seeder 
{
 /***************************
    * Customer_Addresses
    *---------------------------
    * cust_id
    * country
    * province
    * city
    * street
    * apt_num
    * postal_code
    * note
    ****************************/

    public function run()
    {
    	// must be call after seeding for userTable
        
    	$user1 = User::where('email', '=', 'cust_1@sfu.ca')->first();
    	$customer = Customer::where(array('user_id' => $user1->user_id))->first();

        $cust_city_array = array('burnaby', 'vancouver', 'richmond');
        $cust_street_array = array('street1', 'street2', 'street3', 'street4', 'street5');
        $cust_postalcode_array = array('V5A2R3','V9F3H6','V8SF9G');
    	
        for ( $i = 1; $i <= 5; $i++ )
        {
            $user = User::where('email', '=', 'cust_'.$i.'@sfu.ca')->first();
            $customer = Customer::where(array('user_id' => $user->user_id))->first();
            $addr = new CustAddr;
            $addr->cust_id = $customer->cust_id;
            $addr->city = $cust_city_array[rand(0,2)];
            $addr->street = $cust_street_array[rand(0,4)];
            $addr->apt_num = 1;
            $addr->postal_code = $cust_postalcode_array[rand(0,2)];
            $addr->save();
        }

        for ( $i = 1; $i <= 5; $i++ )
        {
            $user = User::where('email', '=', 'cust_'.$i.'@sfu.ca')->first();
            $customer = Customer::where(array('user_id' => $user->user_id))->first();
            $addr = new CustAddr;
            $addr->cust_id = $customer->cust_id;
            $addr->city = $cust_city_array[rand(0,2)];
            $addr->street = $cust_street_array[rand(0,4)];
            $addr->apt_num = 1;
            $addr->postal_code = $cust_postalcode_array[rand(0,2)];
            $addr->save();
        }

  }
 
}
