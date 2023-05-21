<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->integer('sort_order');
			$table->string('key_id', 255)->primary();
			$table->string('title_en', 255);
			$table->string('title_ar', 255);
			$table->longText('value')->nullable();
			$table->string('set_group', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
