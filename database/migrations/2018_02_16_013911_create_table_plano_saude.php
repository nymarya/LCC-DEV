<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlanoSaude extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planos_saude', function (Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->float('motora_UTI');
            $table->float('motora_APT');
            $table->float('resp_UTI');
            $table->float('resp_APT');
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
        Schema::dropIfExists('planos_saude');
    }
}
