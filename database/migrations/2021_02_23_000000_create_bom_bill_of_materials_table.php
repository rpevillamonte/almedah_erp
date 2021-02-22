<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomBillOfMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_bill_of_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('product_code', 10);
            $table->integer('quantity')->unsigned();
            $table->string('unit', 6);
            $table->string('bom_status', 10);
            $table->string('currency', 6);
            $table->boolean('is_active');
            $table->boolean('is_default');
            $table->boolean('allow_alternative_item');
            $table->boolean('set_rate_sub_assembly_item');
            $table->integer('total_cost')->unsigned();
            $table->timestamps();
            // $table->foreign('customer_id')->references('customer_id')->on('');
            $table->foreign('product_code')->references('product_code')->on('man_products');
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
