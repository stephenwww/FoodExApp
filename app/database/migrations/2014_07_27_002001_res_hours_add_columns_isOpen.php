<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResHoursAddColumnsIsOpen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('res_hours', function($table){
			$table->boolean('mon_isClosed')->default(False);
			$table->boolean('tues_isClosed')->default(False);
			$table->boolean('weds_isClosed')->default(False);
			$table->boolean('thurs_isClosed')->default(False);
			$table->boolean('fri_isClosed')->default(False);
			$table->boolean('sat_isClosed')->default(False);
			$table->boolean('sun_isClosed')->default(False);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('res_hours', function($table){
			$table->dropColumn('mon_isClosed');
			$table->dropColumn('tues_isClosed');
			$table->dropColumn('weds_isClosed');
			$table->dropColumn('thurs_isClosed');
			$table->dropColumn('fri_isClosed');
			$table->dropColumn('sat_isClosed');
			$table->dropColumn('sun_isClosed');
		});
	}

}
