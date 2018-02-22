<?php

use Illuminate\Database\Seeder;

class QuestoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $questao = factory(\App\Models\Questao::class,10)
                ->create([
                    'assunto_id' => factory(\App\Assunto::class)->create()->id,
                ])->each(function ($questao) {
                    factory(\App\Models\Midia::class)
                        ->create([
                            'questao_id' => $questao->id,
                        ]);
                    factory(\App\Models\Alternativa::class)
                        ->create([
                            'correta' => true,
                            'questao_id' => $questao->id,
                        ]);
                    factory(\App\Models\Alternativa::class)
                        ->create([
                            'correta' => false,
                            'questao_id' => $questao->id,
                        ]);
                    factory(\App\Models\Alternativa::class)
                        ->create([
                            'correta' => false,
                            'questao_id' => $questao->id,
                        ]);
                    factory(\App\Models\Alternativa::class)
                        ->create([
                            'correta' => false,
                            'questao_id' => $questao->id,
                        ]);
                });
    }
}
