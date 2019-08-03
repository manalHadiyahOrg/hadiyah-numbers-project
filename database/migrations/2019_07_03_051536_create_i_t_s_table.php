<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateITSTable extends Migration
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
        Schema::create('i_t_s', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('f_name');
            $table->string('s_name');
            $table->string('l_name');
            $table->string('email',191)->unique();
            $table->string('password',191);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_t_s');
    }
}
