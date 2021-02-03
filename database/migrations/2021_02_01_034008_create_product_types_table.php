<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MAN_PRODUCTS_TYPOLOGY', function (Blueprint $table) {
            $table->string('PRODUCT_TYPE')->primary();
            $table->string('PRODUCT_SUBTYPE');
            $table->string('PROCUREMENT_METHOD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MAN_PRODUCTS_TYPOLOGY');
    }
}
