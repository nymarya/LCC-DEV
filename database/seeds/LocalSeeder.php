<?php

use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Local::insert([
            ['nome' => 'Apartamento'],
            ['nome' => 'UTI'],
        ]);
    }
}
