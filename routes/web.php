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

});

Auth::routes();

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('planos', 'PlanoSaudeController');
});

Route::group(['namespace' => 'Roles'], function (){
    Route::resource('pacientes', 'PacienteController');
});
