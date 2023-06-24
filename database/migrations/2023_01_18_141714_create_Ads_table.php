<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsTable extends Migration {

	public function up()
	{
		Schema::create('ads', function(Blueprint $table) {
			$table->increments('id');
            $table->enum('type' , ['general' , 'order']);
			$table->string('title_en', 255);
			$table->string('title_ar', 255);
			$table->longText('url')->default('#');
			$table->longText('image')->nullable();
            $table->integer('status')->default('1');
            $table->string('location' , 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ads');
	}
}
