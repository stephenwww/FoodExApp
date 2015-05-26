<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/*
   Purpose: 
 	Restaurants are unable to delete dishes from their list of
 	dishes because of a foreign key constraint on the order_dishes
 	table. To fix this issue, the "exists" attribute is added to 
 	the dishes table.
 	Now when restaurants delete dishes, the exist value is set to
    false.
   Post Conditions:
   	A restaurant's gallery will only show dishes with 'serving' = true
   	A restaurant's dish management will have an "archived" dishes
   	section.   		
 */
class DishTableAddExistColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dishes', function($table){
			$table->boolean('serving')->default(True);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dishes', function($table){
			$table->dropColumn('serving');
		});
	}

}
