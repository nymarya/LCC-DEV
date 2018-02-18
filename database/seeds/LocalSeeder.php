<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locais')->insert([
            'nome' => 'andar 1'
        ]);
    }
}
