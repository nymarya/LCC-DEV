<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('admissao');
            $table->date('alta')->nullable();
            $table->integer('quant_mot');
            $table->integer('quant_resp');
            $table->integer('paciente_id')->unsigned();
            $table->integer('plano_saude_id')->unsigned();
            $table->integer('local_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('plano_saude_id')->references('id')->on('planos_saude');
            $table->foreign('local_id')->references('id')->on('locais');
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
        Schema::dropIfExists('vinculos');
    }
}
