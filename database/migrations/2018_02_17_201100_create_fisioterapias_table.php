<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFisioterapiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fisioterapias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fisioterapia_tipo')->nullable();
            $table->date('dia');
            $table->integer('vinculo_id')->unsigned();
            $table->foreign('vinculo_id')->references('id')->on('vinculos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fisioterapias');
    }
}
