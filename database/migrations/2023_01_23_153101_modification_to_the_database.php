<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->boolean('status')->after('name_ar')->default(1);
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->boolean('status')->after('name_ar')->default(1);
        });

        Schema::table('payment_options', function (Blueprint $table) {
            $table->boolean('status')->after('image')->default(1);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->timestamp('end_at')->after('maximum')->nullable();
            $table->boolean('status')->after('end_at')->default(1);
        });

        Schema::table('shipping_options', function (Blueprint $table) {
            $table->integer('first_cleo')->after('work')->nullable();
            $table->integer('Price_kilo_after_first')->after('first_cleo')->nullable();
            $table->boolean('status')->after('Price_kilo_after_first')->default(1);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')->after('id_city')->default(1);
            $table->longText('avatar')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('payment_options', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('end_at');
        });

        Schema::table('shipping_options', function (Blueprint $table) {
            $table->dropColumn('first_cleo');
            $table->dropColumn('Price_kilo_after_first');
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('avatar');
        });
    }
};
