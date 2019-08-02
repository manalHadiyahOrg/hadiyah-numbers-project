<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitableFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitable__forms', function (Blueprint $table) {
          $table->engine = 'InnoDB';

          $table->date('date');
          $table->string('day');
      //    $table->string('city');
          $table->string('evaluation');
          $table->integer('nu_service_providers')->unsigned();
          $table->integer('number_of_beneficiaries')->unsigned();
          $table->string('observation')->nullable();
          $table->increments('form_id')->unique();
          $table->integer('observe_id')->unsigned()->nullable();
          $table->integer('service_id')->unsigned()->nullable();
          $table->integer('location_id')->unsigned()->nullable();

      });
      Schema::table('hospitable__forms', function($table) {
          $table->foreign('observe_id')->references('id')->on('observers')->onDelete('set null');
           $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
           $table->foreign('location_id')->references('id')->on('location')->onDelete('set null');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitable__forms');
    }
}
