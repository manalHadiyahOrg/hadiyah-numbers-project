<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodOfAlgebratFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood__of__algebrat__forms', function (Blueprint $table) {

          $table->increments('form_id')->unique();
          $table->string('date');
          $table->string('day');
          $table->integer('observe_id')->unsigned()->nullable();
          $table->integer('count_of_agencies');
          $table->integer('service_id')->unsigned()->nullable();
      });
      Schema::table('blood__of__algebrat__forms', function($table) {
          $table->foreign('observe_id')->references('id')->on('observers')->onDelete('set null');
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
        Schema::dropIfExists('blood__of__algebrat__forms');
    }
}
