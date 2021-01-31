<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('env_raw_materials'))
        {
                Schema::create('env_raw_materials', function (Blueprint $table) {
                $table->id();
                $table->string('material_code');
                $table->string('material_name');
                $table->string('material_image');
                $table->string('material_category');
                $table->float('unit_price');
                $table->float('total_amount');
                $table->string('rm_status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('env_raw_materials');
    }
}
