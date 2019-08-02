<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareFormMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care__form__materials', function (Blueprint $table) {

          $table->engine = 'InnoDB';

          $table->integer('count');
          $table->integer('form_id')->unsigned()->nullable();
          $table->integer('material_id')->unsigned()->nullable();
      });
      Schema::table('care__form__materials', function($table) {
          $table->foreign('form_id')->references('form_id')->on('care__forms')->onDelete('set null');
           $table->foreign('material_id')->references('id')->on('materials')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('care__form__materials');
    }
}
