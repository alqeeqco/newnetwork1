<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('shipping_options', function(Blueprint $table) {
			$table->foreign('id_countries')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('id_country')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('favorite', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('favorite', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
//		Schema::table('Order', function(Blueprint $table) {
//			$table->foreign('user_id')->references('id')->on('users')
//						->onDelete('cascade')
//						->onUpdate('cascade');
//		});
//		Schema::table('Order', function(Blueprint $table) {
//			$table->foreign('product_id')->references('id')->on('products')
//						->onDelete('cascade')
//						->onUpdate('cascade');
//		});
//		Schema::table('admin_permission', function(Blueprint $table) {
//			$table->foreign('admin_id')->references('id')->on('admins')
//						->onDelete('cascade')
//						->onUpdate('cascade');
//		});
//		Schema::table('admin_permission', function(Blueprint $table) {
//			$table->foreign('permission_id')->references('id')->on('permissions')
//						->onDelete('cascade')
//						->onUpdate('cascade');
//		});
		Schema::table('colors', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
//		Schema::table('carts', function(Blueprint $table) {
//			$table->foreign('user_id')->references('id')->on('users')
//						->onDelete('cascade')
//						->onUpdate('cascade');
//		});
//		Schema::table('carts', function(Blueprint $table) {
//			$table->foreign('product_id')->references('id')->on('products')
//						->onDelete('cascade')
//						->onUpdate('cascade');
//		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('id_city')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_category_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_user_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_product_id_foreign');
		});
		Schema::table('shipping_options', function(Blueprint $table) {
			$table->dropForeign('shipping_options_id_countries_foreign');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_id_country_foreign');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->dropForeign('address_user_id_foreign');
		});
		Schema::table('address', function(Blueprint $table) {
			$table->dropForeign('address_city_id_foreign');
		});
		Schema::table('favorite', function(Blueprint $table) {
			$table->dropForeign('favorite_user_id_foreign');
		});
		Schema::table('favorite', function(Blueprint $table) {
			$table->dropForeign('favorite_product_id_foreign');
		});
		Schema::table('Order', function(Blueprint $table) {
			$table->dropForeign('Order_user_id_foreign');
		});
		Schema::table('Order', function(Blueprint $table) {
			$table->dropForeign('Order_product_id_foreign');
		});
		Schema::table('admin_permission', function(Blueprint $table) {
			$table->dropForeign('admin_permission_admin_id_foreign');
		});
		Schema::table('admin_permission', function(Blueprint $table) {
			$table->dropForeign('admin_permission_permission_id_foreign');
		});
		Schema::table('colors', function(Blueprint $table) {
			$table->dropForeign('colors_product_id_foreign');
		});
		Schema::table('carts', function(Blueprint $table) {
			$table->dropForeign('carts_user_id_foreign');
		});
		Schema::table('carts', function(Blueprint $table) {
			$table->dropForeign('carts_product_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_id_city_foreign');
		});
	}
}
