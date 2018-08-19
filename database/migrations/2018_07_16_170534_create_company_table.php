<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('company',function(Blueprint $table){
                $table->increments('id');
                $table->string('company_id');
                $table->string('type');
                $table->string('sub_type');
                $table->string('value');
                $table->string('description');
                $table->date('created_date');
                $table->date('updated_date');
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
        Schema::dropIfExists('company');
    }
}
