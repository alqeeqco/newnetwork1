<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_country')->unsigned();
			$table->string('name_en', 255);
			$table->string('name_ar', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}
