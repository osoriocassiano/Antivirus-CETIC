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
    return view('auth.login');
});


Route::group(['namespace'=>'Painel', 'middleware'=>'auth'], function(){

    Route::get('/dentro_prazo', 'LicencaController@dentroDoPrazo');
    Route::get('/listar_todos', 'LicencaController@listarTodos');
    Route::post('/listar_por_prazo', 'LicencaController@listarPorPrazo');

    Route::resource('/licenca', 'LicencaController');
    Route::resource('/usuario_pc', 'UsuarioPcController');
    Route::resource('/usuario_sistema', 'UsuarioSistemaController');
    Route::resource('/antivirus', 'AntivirusController');
    Route::resource('/prazo', 'PrazoController');
    Route::resource('/cargo', 'CargoController');
    Route::resource('/tipo_usuario', 'TipoUsuarioController');



});
/*Route::group(['middleware' => 'web'], function(){
    Route::auth();
    Route::get('/home', 'HomeController@index');
});*/
Auth::routes();

Route::get('/home', 'HomeController@index');
