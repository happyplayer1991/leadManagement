<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items',function(Blueprint $table){
                $table->increments('id')->unique();
                $table->string('product_id');
                $table->string('product_key');
                $table->string('description');
                $table->string('price');
                $table->string('qty');
                $table->string('discount');
                $table->string('status');
                $table->integer('invoice_id')->unsigned();
                $table->foreign('invoice_id')->references('id')->on('invoices');
                $table->integer('lead_id')->unsigned();
                $table->foreign('lead_id')->references('id')->on('leads');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('invoice_items');
    }
}
