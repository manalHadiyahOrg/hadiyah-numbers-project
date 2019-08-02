<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisers', function (Blueprint $table) {
           $table->increments('id')->unique();
            $table->string('f_name');
            $table->string('s_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('password',255);
            $table->integer('admin_id')->unsigned()->nullable();
            $table->integer('program_id')->unsigned()->nullable();


        });



        Schema::table('supervisers', function($table) {
              $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
              $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
          });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisers');
    }
}
