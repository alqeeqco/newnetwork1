<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email', 255)->unique();
			$table->longText('avatar')->nullable();
			$table->string('name', 255);
			$table->longText('password');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}
}
