<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdoptionOfTheCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption__of__the__committees', function (Blueprint $table) {
          $table->integer('form_id')->unsigned()->nullable();
          $table->string('name');
          $table->string('observation')->nullable();

        });
        Schema::table('adoption__of__the__committees', function($table) {

              $table->foreign('form_id')->references('form_id')->on('blood__of__algebrat__forms')->onDelete('set null');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoption__of__the__committees');
    }
}
