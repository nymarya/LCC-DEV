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
            [
                'nome' => 'Sesap',
                'motora_UTI' => 0.00,
                'motora_APT' =>12.50,
                'resp_UTI' =>0.00,
                'resp_APT' => 12.50
            ], [
                'nome' => 'UNIMED',
                'motora_UTI' => 0.00,
                'motora_APT' =>0.00,
                'resp_UTI' =>0.00,
                'resp_APT' => 0.00
            ],[
                'nome' => 'Cassi',
                'motora_UTI' => 39.75,
                'motora_APT' =>39.75,
                'resp_UTI' =>21.68,
                'resp_APT' =>21.68
            ],[
                'nome' => 'SUS',
                'motora_UTI' => 4.67,
                'motora_APT' =>4.67,
                'resp_UTI' =>4.67,
                'resp_APT' =>4.67
            ],[
                'nome' => 'Petrobras',
                'motora_UTI' => 70.00,
                'motora_APT' => 40.00,
                'resp_UTI' => 70.00,
                'resp_APT' => 40.00
            ],[
                'nome' => 'Assefaz',
                'motora_UTI' => 25.60,
                'motora_APT' => 25.60,
                'resp_UTI' => 12.80,
                'resp_APT' => 12.80
            ],[
                'nome' => 'Bradesco Saude',
                'motora_UTI' => 10.16 ,
                'motora_APT' => 10.16,
                'resp_UTI' => 9.30,
                'resp_APT' => 9.30
            ],[
                'nome' => 'Camed',
                'motora_UTI' => 12.50,
                'motora_APT' =>12.50,
                'resp_UTI' =>9.30,
                'resp_APT' =>9.30
            ],[
                'nome' => 'Capesaude',
                'motora_UTI' => 21.09,
                'motora_APT' =>21.09,
                'resp_UTI' => 19.80,
                'resp_APT' => 19.80
            ],[
                'nome' => 'Embratel',
                'motora_UTI' => 15.56,
                'motora_APT' =>15.56,
                'resp_UTI' =>15.56,
                'resp_APT' =>15.56
            ],[
                'nome' => 'Gama Saude',
                'motora_UTI' => 15.56,
                'motora_APT' =>15.56,
                'resp_UTI' =>15.56,
                'resp_APT' =>15.56
            ],[
                'nome' => 'Geap',
                'motora_UTI' => 12.24,
                'motora_APT' =>12.24,
                'resp_UTI' =>8.06,
                'resp_APT' =>8.06
            ],[
                'nome' => 'Golden Cross',
                'motora_UTI' => 8.40,
                'motora_APT' =>8.40,
                'resp_UTI' =>8.40,
                'resp_APT' =>8.40
            ],[
                'nome' => 'Life Empresarial Sau',
                'motora_UTI' => 24.02,
                'motora_APT' =>24.02,
                'resp_UTI' =>24.02,
                'resp_APT' =>24.02
            ],[
                'nome' => 'Mediservice',
                'motora_UTI' => 10.16,
                'motora_APT' =>10.16,
                'resp_UTI' =>9.03,
                'resp_APT' =>9.03
            ],[
                'nome' => 'Norclinica',
                'motora_UTI' => 9.60,
                'motora_APT' =>9.60,
                'resp_UTI' =>9.60,
                'resp_APT' =>9.60
            ],[
                'nome' => 'Notredame',
                'motora_UTI' => 15.56,
                'motora_APT' =>15.56,
                'resp_UTI' =>15.56,
                'resp_APT' =>15.56
            ],[
                'nome' => 'Pame S/C',
                'motora_UTI' => 15.56,
                'motora_APT' =>15.56,
                'resp_UTI' =>15.56,
                'resp_APT' =>15.56
            ],[
                'nome' => 'Postal Saude (Correios)',
                'motora_UTI' => 19.38,
                'motora_APT' =>19.38,
                'resp_UTI' =>19.38,
                'resp_APT' =>19.38
            ],[
                'nome' => 'Saude Caixa PCT',
                'motora_UTI' => 68.25,
                'motora_APT' =>37.18,
                'resp_UTI' =>68.25,
                'resp_APT' =>37.18
            ],[
                'nome' => 'Smile',
                'motora_UTI' => 22.31,
                'motora_APT' =>22.31,
                'resp_UTI' =>22.31,
                'resp_APT' =>22.31
            ],[
                'nome' => 'Vitallis Saude',
                'motora_UTI' => 14.95,
                'motora_APT' =>14.95,
                'resp_UTI' =>14.95,
                'resp_APT' =>14.95
            ],
        ]);
    }
}
