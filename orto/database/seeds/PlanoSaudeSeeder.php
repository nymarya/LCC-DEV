<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class PlanoSaudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planos_saude')->insert([
            'nome' => 'Sesap'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Cassi'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Sus'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'BR Petrobras PCT'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Assefaz'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Bradesco Saude'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Camed'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Capesaude'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Embratel'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Gama Saude'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Geap'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Golden Cross'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Life Empresarial Sau'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Mediservice'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Norclinica'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Notredame'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Pame S/C'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Petrobras PCT'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Postal Saude (Correios)'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Saude Caixa PCT'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Smile'
        ]);

        DB::table('planos_saude')->insert([
            'nome' => 'Vitallis Saude'
        ]);
    }
}
