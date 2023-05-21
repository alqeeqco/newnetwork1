<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColorsTable extends Migration {

	public function up()
	{
		Schema::create('colors', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->string('color', 255);
			$table->integer('quantity')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('colors');
	}
}