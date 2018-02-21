<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_professores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turma_id')->unsigned();
            $table->integer('professor_id')->unsigned();

            $table->timestamps();

            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('professor_id')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas_professores');
    }
}
