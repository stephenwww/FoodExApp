<?php
 
class AdminOperationTableSeeder extends Seeder 
{
	public function run()
	{
    	for( $i = 1 ; $i <= 100 ; $i++ )
        {
			$operation = new AdminOperation;
			$operation->admin_id = rand(1, 5);
			$operation->res_id = rand(1, 5);
			$operation->op_type = $i%2;
			$operation->op_time = date('Y-m-d H:i:s');
			$operation->save();
        }		
	}
}


?>