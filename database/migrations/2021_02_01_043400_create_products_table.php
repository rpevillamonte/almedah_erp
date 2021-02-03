<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MAN_PRODUCTS', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->string('PRODUCT_CODE')->primary();
            $table->string('PRODUCT_NAME');
            $table->string('PRODUCT_CATEGORY');
            $table->string('PRODUCT_TYPE');
            $table->double('SALES_PRICE_WT', 10, 2);
            $table->string('UNIT');
            $table->string('INTERNAL_DESCRIPTION');
            $table->string('BARCODE');
            $table->string('PICTURE');
            $table->timestamps();
            $table->foreign('PRODUCT_CATEGORY')->references('PRODUCT_CATEGORY')->on('MAN_CATEGORIZATION');
            $table->foreign('PRODUCT_TYPE')->references('PRODUCT_TYPE')->on('MAN_PRODUCTS_TYPOLOGY');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MAN_PRODUCTS');
        /*Schema::table('MAN_PRODUCTS', function (Blueprint $table) {
            //
        });*/
    }
}
