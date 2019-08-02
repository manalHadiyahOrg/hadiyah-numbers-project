<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelegationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegations', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nationality');
            $table->string('address_in_mecca');
            $table->string('address_in_madinah');
            $table->string('arrival_time');
            $table->date('date_of_arrival');
            $table->date('date_of_Visit');
            $table->string('visit_time');
            $table->date('date_of_departure');
            $table->string('departure_time');
            $table->string('coordinator');
            $table->string('contact_number');
            $table->string('number_of_women');
            $table->string('number_of_children');
            $table->string('number_of_men');
            $table->date('date');
            $table->string('day');
            $table->integer('observe_id')->unsigned()->nullable();
            $table->integer('service_id')->unsigned()->nullable();
            $table->string('observation')->nullable();
        });
        Schema::table('delegations', function($table) {
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
        Schema::dropIfExists('delegations');
    }
}
