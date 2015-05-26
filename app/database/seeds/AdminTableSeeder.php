<?php
 
class AdminTableSeeder extends Seeder 
{
	public function run()
	{
    	// must be call after seeding for userTable
    	for( $i = 1 ; $i <= 5 ; $i++ )
        {
            $user = User::where('email', '=', 'admin_'.$i.'@sfu.ca' )->first();
            $admin = new Admin;
            $admin->user_id = $user->user_id;
            $admin->admin_name = 'admin_'. $i .'@sfu.ca';
            $admin->save();
        }		
	}
}


?>