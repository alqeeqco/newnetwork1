<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration {

	public function up()
	{
		Schema::create('coupons', function(Blueprint $table) {
			$table->increments('id');
			$table->string('code', 255);
			$table->decimal('discount', 7,3);
			$table->integer('minimum');
			$table->integer('maximum');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('coupons');
	}
}