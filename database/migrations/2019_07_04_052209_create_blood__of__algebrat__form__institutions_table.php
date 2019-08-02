<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodOfAlgebratFormInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood__of__algebrat__form__institutions', function (Blueprint $table) {
        $table->integer('institution_id')->unsigned()->nullable();
        $table->integer('form_id')->unsigned()->nullable();
        $table->integer('number_of_carcasses');
        $table->string('type');
        $table->string('name_of_delegate');

        });

        Schema::table('blood__of__algebrat__form__institutions', function($table) {
              $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('set null');
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
        Schema::dropIfExists('blood__of__algebrat__form__institutions');
    }
}
