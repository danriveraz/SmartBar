<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');
Route::get('/home', 'HomeController@home');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');



Route::get('auth/profile', 'Auth\AuthController@profile');
Route::get('auth/editProfile' , 'Auth\AuthController@editProfile');
Route::post('auth/updateProfile', 'Auth\AuthController@updateProfile');

Route::group(['prefix' => 'auth'], function(){
  Route::resource('usuario','UsuariosController');
  Route::get('usuario/{id}/destroy', ['uses' => 'UsuariosController@destroy', 'as' => 'auth.usuario.destroy']);
});

Route::resource('auth/insumo', 'insumoController');
Route::resource('auth/producto', 'productoController');
Route::resource('auth/contiene', 'contieneController');

Route::resource('auth/categoria', 'categoriaController');
Route::get('categoria/{id}/destroy', ['uses' => 'CategoriaController@destroy', 'as' => 'auth.categoria.destroy']);


Route::post('bartender/pedido', 'BartenderController@pedido');
Route::get('bartender/tabla', 'BartenderController@mostrarTabla');
Route::resource('bartender', 'BartenderController');

Route::resource('cajero', 'CajeroController');
Route::post('cajero/recibo', 'CajeroController@recibo');

Route::get('mesero/lista', 'MeseroController@lista');
Route::resource('mesero', 'MeseroController');


