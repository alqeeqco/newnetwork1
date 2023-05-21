<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration {

	public function up()
	{
		Schema::create('carts', function(Blueprint $table) {
			$table->uuid('id');
			$table->uuid('cookie_id')->index();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('product_id')->unsigned();
			$table->integer('quantity')->default(1);
			$table->double('total');
			$table->string('note', 255)->nullable();
			$table->boolean('status')->default(1);
			$table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary([
                'id',
                'cookie_id',
            ]);
		});
	}

	public function down()
	{
		Schema::drop('carts');
	}
}
