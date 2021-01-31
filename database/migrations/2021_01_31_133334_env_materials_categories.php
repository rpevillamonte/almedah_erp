<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnvMaterialsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('env_materials_categories'))
        {
            Schema::create('env_materials_categories', function(Blueprint $table){
                $table->id();
                $table->string('category_title');
                $table->string('description');
                $table->integer('quantity');
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
