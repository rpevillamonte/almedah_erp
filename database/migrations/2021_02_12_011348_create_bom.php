<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_bill_of_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('product_code');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('bom_status');
            $table->string('currency');
            $table->float('total_cost', 10, 2);
            $table->integer('is_active');
            $table->integer('is_default');
            $table->integer('allow_alternative_item');
            $table->integer('set_rate_assembly_item');
            //$table->foreign('product_code')->references('product_code')->on('man_products');
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
        Schema::dropIfExists('bom_bill_of_materials');
    }
}
