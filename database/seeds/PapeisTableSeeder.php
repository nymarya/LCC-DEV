<?php

use Illuminate\Database\Seeder;

class PapeisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Roles\Papel::insert([
            ['slug' => 'administrador', 'nome' => 'Administrador'],
            ['slug' => 'aluno', 'nome' => 'Aluno'],
            ['slug' => 'professor', 'nome' => 'Professor'],
        ]);
    }
}
