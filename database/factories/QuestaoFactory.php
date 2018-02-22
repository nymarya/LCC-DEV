<?php


$factory->define(\App\Assunto::class, function (\Faker\Generator $faker) {
    return [
        'assunto' => $faker->text(10),
    ];
});
$factory->define(\App\Models\Questao::class, function (\Faker\Generator $faker) {
    return [
        'questao' => $faker->text(20),
        'assunto_id' => function () {
            return factory(\App\Assunto::class)->create()->id;
        },
    ];
});
$factory->define(\App\Models\Midia::class, function (\Faker\Generator $faker) {
    return [
        'arquivo' => \Illuminate\Http\UploadedFile::fake()->create('arquivo.pdf'),
        'questao_id' => function () {
            return factory(\App\Models\Questao::class)->create()->id;
        },
    ];
});
$factory->define(\App\Models\Alternativa::class, function (\Faker\Generator $faker) {
    return [
        'alternativa' => $faker->text(10),
        'correta' => $faker->boolean(50),
        'questao_id' => function () {
            return factory(\App\Models\Questao::class)->create()->id;
        },
    ];
});
