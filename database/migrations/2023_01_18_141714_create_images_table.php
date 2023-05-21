<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('imageable_type', 255);
			$table->integer('imageable_id');
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}