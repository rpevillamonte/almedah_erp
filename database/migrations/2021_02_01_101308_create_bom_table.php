<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_bill_of_materials', function (Blueprint $table) {
            $table->integer('CUSTOMER_ID');
            $table->string('PRODUCT_CODE');
            $table->integer('QUANTITY');
            $table->string('UNIT');
            $table->string('BOM_STATUS');
            $table->string('CURRENCY');
            $table->float('TOTAL_COST', 10, 2);
            $table->integer('IS_ACTIVE');
            $table->integer('IS_DEFAULT');
            $table->integer('ALLOW_ALTERNATIVE_ITEM');
            $table->integer('SET_RATE_SUB_ASSEMBLY_ITEM');
            $table->timestamps();
            $table->foreign('PRODUCT_CODE')->references('PRODUCT_CODE')->on('MAN_PRODUCTS');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bom_bill_of_materials');
    }
}
