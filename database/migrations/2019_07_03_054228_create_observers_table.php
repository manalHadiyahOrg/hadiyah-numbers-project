<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObserversTable extends Migration
{
  public function boot()
{
    Schema::defaultStringLength(191);
}
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observers', function (Blueprint $table) {
          $table->engine = 'InnoDB';

          $table->increments('id')->unique();
          $table->string('f_name');
          $table->string('s_name');
          $table->string('l_name');
          $table->string('email',191)->unique();
          $table->string('password',191);
          $table->integer('service_id')->unsigned()->nullable();
          $table->integer('superviser_id')->unsigned()->nullable();
          $table->integer('location_id')->unsigned()->nullable();


      });
      Schema::table('observers', function($table) {
           $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
            $table->foreign('superviser_id')->references('id')->on('supervisers')->onDelete('set null');
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
        Schema::dropIfExists('observers');
    }
}
