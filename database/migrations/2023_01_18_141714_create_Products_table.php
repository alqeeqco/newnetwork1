<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->string('code', 255)->nullable();
			$table->string('name_en', 255);
			$table->string('name_ar', 255);
			$table->decimal('price', 7,3);
			$table->string('des_en' , 255)->nullable();
			$table->string('des_ar' , 255)->nullable();
			$table->decimal('tax', 10,2)->nullable();
			$table->integer('status')->default('1');
			$table->longText('image')->nullable();
			$table->decimal('discount', 10,2)->nullable();
			$table->integer('quantity');
			$table->string('appear', 255)->default('all');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
