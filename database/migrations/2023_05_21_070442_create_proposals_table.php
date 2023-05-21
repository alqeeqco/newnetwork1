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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('city' , 255);
            $table->string('fill_name', 255);
            $table->string('phone', 255);
            $table->string('employer', 255);
            $table->unsignedInteger('salary');
            $table->string('job_duration');
            $table->string('total_liabilities', 255);
            $table->boolean('agree_terms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
};
