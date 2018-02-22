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

Auth::routes();

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('planos', 'PlanoSaudeController');
    Route::group(['namespace' => 'Roles'], function () {
        Route::resource('administradores', 'AdministradorController');
        Route::resource('alunos', 'AlunoController');
        Route::resource('professores', 'ProfessorController');
    });

    Route::group(['namespace' => 'Exams'], function () {
        Route::resource('questoes', 'QuestaoController');
    });
});

Route::prefix('api')->group(function (){

});
