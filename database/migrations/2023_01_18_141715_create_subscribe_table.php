<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscribeTable extends Migration {

	public function up()
	{
		Schema::create('subscribe', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('subscribe');
	}
}