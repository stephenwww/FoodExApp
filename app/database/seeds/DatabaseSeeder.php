<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('UserTableSeeder');
		$this->call('CustomerTableSeeder');
		$this->call('RestaurantTableSeeder');
		$this->call('AdminTableSeeder');
		$this->call('CuisineTableSeeder');
		$this->call('ResCuisineTableSeeder');
		$this->call('CustAddrTableSeeder');
		$this->call('OrderTableSeeder');
		$this->call('DishTableSeeder');
		$this->call('OrderDishTableSeeder');
		$this->call('ReviewTableSeeder');
		$this->call('AdminOperationTableSeeder');
	}
}
