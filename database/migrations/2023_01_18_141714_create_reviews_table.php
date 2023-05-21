<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->decimal('rate', 10,2)->default('0.0');
			$table->text('note')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}
