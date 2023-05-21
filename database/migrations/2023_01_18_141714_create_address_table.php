<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration {

	public function up()
	{
		Schema::create('address', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->string('street', 255);
			$table->string('district', 255);
			$table->string('czip', 255);
			$table->string('cpobox', 255);
			$table->string('cmobile', 255);
			$table->longText('note')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('address');
	}
}
