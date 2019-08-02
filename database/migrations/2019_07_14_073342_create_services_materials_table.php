<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_materials', function (Blueprint $table) {
        /*    $table->bigIncrements('id');
            $table->timestamps();*/
          $table->integer('material_id')->unsigned()->nullable();
           $table->integer('service_id')->unsigned()->nullable();

        });
        Schema::table('services_materials', function($table) {
           $table->foreign('material_id')->references('id')->on('materials')->onDelete('set null');
             $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_materials');
    }
}
