<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('papel', 'RolesController@index')->name('perfis:selecionar');
    Route::post('papel', 'RolesController@update')->name('perfis:trocar');

    Route::get('perfil', 'ProfileController@show')->name('perfil');
    Route::post('alterar_avatar', 'ProfileController@alterarAvatar')->name('perfil.avatar');
    Route::post('alterar_senha', 'ProfileController@alterarSenha')->name('senha.alterar');
    Route::get('logout', 'LoginController@logout');
});

Route::post('cadastroAluno', 'Roles\AlunoController@cadastroAluno')->name('cadastroAluno');

Auth::routes();

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('verProva', function () {
        return view('papeis.aluno.prova', [
            'questoes' => \App\Facades\Perfil::papel()->turmas->first()->provas->first()->questoes
        ]);
    });
    Route::post('check', 'Exams\ProvaController@check')->name('check');

    Route::resource('turmas', 'TurmaController');
    Route::get('/', 'HomeController@index');
    Route::resource('assuntos', 'AssuntoController');
    Route::get('turmas/select', 'TurmaController@select')
        ->name('turmas.select');
    Route::group(['namespace' => 'Roles'], function () {
        Route::resource('administradores', 'AdministradorController');
        Route::resource('alunos', 'AlunoController');
        Route::resource('professores', 'ProfessorController');
        Route::get('alunosmatricula', 'ProfessorController@alunos')->name('alunosmatricula');
        Route::post('matricular_aluno/{id}', 'ProfessorController@matricular_aluno')->name('matricular_aluno');
        Route::get('matricula_aluno/{id}', 'ProfessorController@matricula_aluno')->name('matricula_aluno');
    });

    Route::group(['namespace' => 'Exams'], function () {
        Route::resource('questoes', 'QuestaoController');
        Route::get('api/questoes', 'QuestaoController@select')->name('questoes.select');
        Route::resource('provas', 'ProvaController');
    });
});
