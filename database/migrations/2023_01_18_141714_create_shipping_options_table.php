<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingOptionsTable extends Migration {

	public function up()
	{
		Schema::create('shipping_options', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_countries')->unsigned();
			$table->string('name_en', 255);
			$table->string('name_ar', 255);
			$table->longText('image');
			$table->text('des_en');
			$table->text('des_ar');
			$table->decimal('price', 7,3);
			$table->string('work', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('shipping_options');
	}
}
