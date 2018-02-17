<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlanoSaudeSeeder::class);
        $this->call(PapeisTableSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
