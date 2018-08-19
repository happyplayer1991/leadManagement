<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('session_id');
            $table->string('name');
            $table->string('email');
            $table->string('primary_number');
            $table->string('secondary_number');
            $table->string('drop_status');
            $table->string('lead_stage');
            $table->string('comment');
            $table->string('company_name');
            $table->string('address');
            $table->string('country');
            $table->string('pin');
            $table->string('company_website');
            $table->string('annual_revenue');
            $table->string('number_employee');
            $table->string('fax');
            $table->string('interested_product');
            $table->string('returned_user');
             $table->string('lead_type');            
             $table->string('company_id');
             $table->integer('source_id');
             $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('industry_id');
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
        Schema::drop('leads');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
