<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //senha é 123456
        $usuario = factory(\App\User::class)->create([
            'name' => 'Admin',
            'email' => 'uadmin@admin.com',
            'password' => '$2y$10$qGLNOd9PMgosCCT90yNXF.CMzo8VkLw49eP8zXUQ2NkD/hv8YYMZ6'
        ]);

        $usuario->perfis()->create(['tipo' => 'administrador'])
            ->papel()->create([]);

    }
}
