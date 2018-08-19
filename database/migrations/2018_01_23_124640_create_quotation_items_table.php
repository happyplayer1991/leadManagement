<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items',function(Blueprint $table){
                $table->increments('id')->unique();
                $table->string('product_id');
                $table->string('product_key');
                $table->string('description');
                $table->string('price');
                $table->string('qty');
                $table->string('discount');
                $table->string('total');
                $table->string('quote_id');
                $table->string('lead_id');
                $table->string('user_id');
                $table->string('company_id');
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
        Schema::drop('quotation_items');
    }
}
