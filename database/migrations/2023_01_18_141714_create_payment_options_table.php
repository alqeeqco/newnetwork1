<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentOptionsTable extends Migration {

	public function up()
	{
		Schema::create('payment_options', function(Blueprint $table) {
			$table->increments('id');
			$table->longText('image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('payment_options');
	}
}