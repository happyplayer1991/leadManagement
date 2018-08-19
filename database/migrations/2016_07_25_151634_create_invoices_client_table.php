<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->references('id')->on('leads');
            $table->integer('invoice_id')->references('id')->on('invoices');
            $table->string('status');
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
        Schema::drop('lead_invoice');
    }
}
