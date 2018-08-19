<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotation_number');
            $table->integer('lead_id')->unsigned();
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('company_id');
            $table->string('deleted_at');
            $table->string('discount');
            $table->date('quotation_date');
            $table->string('terms');
            $table->string('public_notes');
            $table->string('is_deleted');
            $table->string('tax_amount');
            $table->string('amount');
            $table->string('quote_id');
            $table->string('quote_footer');
            $table->string('currency');
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
         Schema::drop('quotations');
    }
}
