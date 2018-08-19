<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('paid_amount');
            $table->string('due_amount');
        });

         Schema::table('invoices', function (Blueprint $table) {
            $table->string('paid_amount');
            $table->string('due_amount');
            $table->string('quotation_number');
        });

         Schema::table('quotation_items', function (Blueprint $table) {
            $table->string('quotation_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
