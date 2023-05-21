<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration {

	public function up()
	{
		Schema::create('countries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_en', 255);
			$table->string('name_ar', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('countries');
	}
}
