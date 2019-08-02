<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table__codes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('table_name');
            $table->integer('program_id')->unsigned()->nullable();
        });
        Schema::table('table__codes', function($table) {
          $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table__codes');
    }
}
