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
        /*
        Schema::create('man_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_status');
            $table->string('product_category');
            $table->string('product_type');
            $table->string('sales_price_wt', 6, 2);
            $table->string('unit');
            $table->string('internal_description');
            $table->string('bar_code');
            $table->string('picture');
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::table('man_products', function (Blueprint $table) {
            //
        });
        */
    }
}
