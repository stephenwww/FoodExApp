<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDB extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*
		*	Create the users table
		*/
		Schema::create('users', function($table) {
            $table->increments('user_id');
            $table->string('username', 16);
            $table->string('password', 60);
            $table->string('code', 60);
            $table->string('tmp_password', 60);
            $table->string('email')->unique(); // add unique here
            $table->boolean('is_confirmed_email')->default(False);
            $table->tinyInteger('role');
            $table->rememberToken();
        });

		/*
		*	create the customers table
		*/
        Schema::create('customers', function($table) {
            $table->increments('cust_id');
            $table->unsignedInteger('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('cust_tel');
            $table->float('cust_points');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        /*
        *	create the restaurants table
        */
        Schema::create('restaurants', function($table) {
            $table->increments('res_id');
            $table->unsignedInteger('user_id');
            $table->string('res_name');
            $table->string('res_email');
            $table->string('res_tel');
            $table->string('res_country')->default('Canada');
            $table->string('res_province')->default('BC');
         	$table->string('res_city');
         	$table->string('res_street');
         	$table->string('res_postalcode');
         	$table->string('about_us');
         	$table->boolean('is_deliver')->default(true);
         	$table->boolean('is_available')->default(true);
         	$table->string('logo_path')->default('imgs/rest_imgs/default.jpg');
         	$table->timestamp('open_time');
         	$table->timestamp('close_time');
            $table->float('score');
            $table->boolean('legitimate')->default(false);

            $table->foreign('user_id')->references('user_id')->on('users');
        });

        // create admins table
        Schema::create('admins', function(Blueprint $table) {
            $table->increments('admin_id');
            $table->unsignedInteger('user_id'); 
            $table->string('admin_name');                       
            $table->timestamp('operation_date');

            $table->foreign('user_id')->references('user_id')->on('users');
        });

        /*
        *	create customer_addresses table, customers may have multiple addresses
        */
        Schema::create('customer_addresses', function($table) {
        	$table->increments('cust_addr_id');
            $table->unsignedInteger('cust_id');
            $table->string('country')->default('Canada');
            $table->string('province')->default('BC');
            $table->string('city');
            $table->string('street');
            $table->string('apt_num');
            $table->string('postal_code');
            $table->string('note');

            $table->unique('cust_addr_id', 'cust_id');
            $table->foreign('cust_id')->references('cust_id')->on('customers');
        });

        /*
        *	create orders table
        */
        Schema::create('orders', function($table){
            $table->increments('order_id');
            $table->unsignedInteger('cust_id');
            $table->unsignedInteger('res_id');
            $table->unsignedInteger('cust_addr_id')->nullable();
            $table->timestamp('order_time');
            $table->float('order_price');
            $table->boolean('is_fulfilled')->default(0);
            $table->boolean('is_sent')->default(0);
            $table->tinyInteger('order_service_type');
            $table->foreign('cust_id')->references('cust_id')->on('customers');
            $table->foreign('res_id')->references('res_id')->on('restaurants');
            $table->foreign('cust_addr_id')->references('cust_addr_id')->on('customer_addresses');
		});

		Schema::create('reviews', function($table){
        	$table->increments('review_id');
        	$table->unsignedInteger('res_id');
        	$table->unsignedInteger('cust_id');
            $table->unsignedInteger('order_id');
        	$table->text('review_content')->default(NULL);
        	$table->integer('review_score')->default(NULL);
        	$table->timestamps();

            $table->foreign('cust_id')->references('cust_id')->on('customers');
            $table->foreign('res_id')->references('res_id')->on('restaurants');
            $table->foreign('order_id')->references('order_id')->on('orders');
        });



        Schema::create('dishes', function($table){
        	  $table->increments('dish_id');
              $table->unsignedInteger('res_id');
              $table->string('dish_name');
			  $table->float('dish_price');
              $table->string('dish_description');
			  $table->string('dish_pic_path');
			  $table->foreign('res_id')->references('res_id')->on('restaurants');
        });

        Schema::create('order_dishes', function($table){
			$table->increments('order_dish_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('dish_id');
			$table->integer('dish_amount');
			
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('dish_id')->references('dish_id')->on('dishes');
		});

		Schema::create('cuisines', function($table) {
            $table->increments('cuisine_id');
            $table->string('cuisine_name');
        });

		Schema::create('restaurant_cuisines', function($table) {
			$table->increments('res_cuisine_id');
			$table->unsignedInteger('res_id');
			$table->unsignedInteger('cuisine_id');

            $table->unique(array('res_id', 'cuisine_id'));
          	$table->foreign('res_id')->references('res_id')->on('restaurants');
          	$table->foreign('cuisine_id')->references('cuisine_id')->on('cuisines')
            ->onDelete('cascade');
        });

        Schema::create('res_hours', function($table) {
            $table->increments('res_hours_id');
            $table->unsignedInteger('res_id');
            $table->foreign('res_id')->references('res_id')->on('restaurants');

            $table->time('open_mon')->default('00:00:00');
            $table->time('open_tues')->default('00:00:00');
            $table->time('open_weds')->default('00:00:00');
            $table->time('open_thurs')->default('00:00:00');
            $table->time('open_fri')->default('00:00:00');
            $table->time('open_sat')->default('00:00:00');
            $table->time('open_sun')->default('00:00:00');

            $table->time('close_mon')->default('00:00:00');
            $table->time('close_tues')->default('00:00:00');
            $table->time('close_weds')->default('00:00:00');
            $table->time('close_thurs')->default('00:00:00');
            $table->time('close_fri')->default('00:00:00');
            $table->time('close_sat')->default('00:00:00');
            $table->time('close_sun')->default('00:00:00');
        });

        Schema::create('admin_operations', function($table) {
            $table->increments('op_id');
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('res_id');
            $table->tinyInteger('op_type');
            $table->timestamp('op_time');

            $table->foreign('admin_id')->references('admin_id')->on('admins');
            $table->foreign('res_id')->references('res_id')->on('restaurants');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('admin_operations');
		Schema::drop('restaurant_cuisines');
		Schema::drop('cuisines');
		Schema::drop('order_dishes');
		Schema::drop('dishes');
		Schema::drop('reviews');
		Schema::drop('orders');
		Schema::drop('customer_addresses');
        Schema::drop('res_hours');
        Schema::drop('admins');
		Schema::drop('restaurants');
		Schema::drop('customers');
		Schema::drop('users');
	}

}

