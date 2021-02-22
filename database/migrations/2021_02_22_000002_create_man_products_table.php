<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('man_products', function (Blueprint $table) {
            $table->string('picture');
            $table->string('product_code', 10)->primary();
            $table->string('product_name', 30);
            $table->string('product_category', 20);
            $table->string('product_type', 20);
            $table->integer('sales_price_wt')->unsigned();
            $table->string('unit', 6);
            $table->string('internal_description', 300);
            $table->string('bar_code', 12);
            $table->timestamps();
            $table->foreign('product_category')->references('product_category')->on('man_categorization');
            $table->foreign('product_type')->references('product_type')->on('man_products_typology');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('man_products', function (Blueprint $table) {
            //
        });
    }
}
