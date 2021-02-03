<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MAN_CATEGORIZATION', function (Blueprint $table) {
            $table->string('ACCOUNTING_FAMILY');
            $table->string('PRODUCT_CATEGORY')->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MAN_CATEGORIZATION');
    }
}
