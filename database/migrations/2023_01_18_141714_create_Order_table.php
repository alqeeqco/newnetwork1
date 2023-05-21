<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id')->nullable()->unsigned();
			// $table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->string('awbNo' , 255)->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('number')->unique();
            $table->string('payment_method');
			$table->enum('status', ['pending', 'processing', 'delivering', 'completed', 'cancelled', 'refunded'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
			$table->string('note', 255)->nullable();
			$table->string('voucherCode', 255)->nullable();
			$table->string('customerId', 255)->nullable();
			$table->string('applicationId', 255)->nullable();
			$table->char('otpID_preRedeem', 50)->nullable();
			$table->string('voucher_id', 255)->nullable();
			$table->string('voucher_amount', 255)->nullable();
			$table->string('voucher_currency', 255)->nullable();
			$table->timestamp('voucher_createdAt')->nullable();
			$table->timestamp('voucher_expiryDate')->nullable();
			$table->string('voucher_status', 255)->nullable();
			$table->string('voucher_applicationId', 255)->nullable();
			$table->char('voucher_transactionId', 50)->nullable();
			$table->timestamp('voucher_timestamp')->nullable();

		});
	}

	public function down()
	{
		Schema::drop('Order');
	}
}
