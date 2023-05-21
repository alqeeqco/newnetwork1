<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWhyChooseUsTable extends Migration {

	public function up()
	{
		Schema::create('why_choose_us', function(Blueprint $table) {
			$table->increments('id');
			$table->longText('image');
			$table->string('title_en', 255);
			$table->string('title_ar', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('why_choose_us');
	}
}