<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocosQuestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocos_questoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bloco_id')->unsigned();
            $table->integer('questao_id')->unsigned();

            $table->timestamps();

            $table->foreign('bloco_id')->references('id')->on('blocos');
            $table->foreign('questao_id')->references('id')->on('questoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocos_questoes');
    }
}
