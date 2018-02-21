<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turma_id')->unsigned();
            $table->integer('aluno_id')->unsigned();

            $table->timestamps();

            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->foreign('aluno_id')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas_alunos');
    }
}
