<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadUserProductNumberinTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_code');
            $table->string('user_number');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('lead_number');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('product_number');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->string('end_date');
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
