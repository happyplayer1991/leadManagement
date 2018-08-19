<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Documents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
               $table->increments('id');
               $table->string('name');
                 $table->string('size');
                 $table->string('path');
                 $table->string('file_display');
                 $table->integer('lead_id')->unsigned();
                 $table->foreign('lead_id')->references('id')->on('leads');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('documents');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
