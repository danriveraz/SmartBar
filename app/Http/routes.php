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

Route::get('Auth/register', 'Auth\AuthController@getRegister');
Route::post('Auth/register', 'Auth\AuthController@postRegister');

Route::get('Auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');


Route::get('Auth/login', 'Auth\AuthController@getLogin');
Route::post('Auth/login', 'Auth\AuthController@postLogin');
Route::get('Auth/logout', 'Auth\AuthController@getLogout');



Route::get('Auth/profile', 'Auth\AuthController@profile');
Route::get('Auth/editProfile' , 'Auth\AuthController@editProfile');
Route::post('Auth/updateProfile', 'Auth\AuthController@updateProfile');

Route::group(['prefix' => 'Auth'], function(){
  Route::resource('usuario','UsuariosController');
  Route::get('usuario/{id}/destroy', ['uses' => 'UsuariosController@destroy', 'as' => 'Auth.usuario.destroy']);
});

Route::get('insumo/eliminar', 'InsumoController@eliminar');
Route::get('insumo/modificar', 'InsumoController@modificar');
Route::get('inslistall/{page?}', 'InsumoController@listall');
Route::resource('insumo', 'InsumoController');

Route::get('producto/eliminar', 'ProductoController@eliminar');
Route::get('producto/modificar', 'ProductoController@modificar');
Route::resource('producto', 'ProductoController');
Route::get('prodlistall', 'ProductoController@listall');
Route::get('producto/{id}/insumoedit', ['uses' => 'ProductoController@insumoedit', 'as' => 'producto.insumoedit']);

Route::get('contiene/eliminar', 'ContieneController@eliminar');
Route::get('contiene/guardar', 'ContieneController@guardar');
Route::get('contlistall/{page?}','ContieneController@listall');
Route::resource('contiene', 'ContieneController');

Route::get('proveedor/eliminar','ProveedorController@eliminar');
Route::get('proveedor/modificar','ProveedorController@modificar');
Route::get('provlistall/{page?}', 'ProveedorController@listall');
Route::get('provlistall/{nombre?}', 'ProveedorController@buscar');
Route::resource('proveedor', 'ProveedorController');

Route::resource('categoria', 'CategoriaController');
Route::get('catlistall', 'CategoriaController@listall');
Route::get('categoria/{id}/destroy', ['uses' => 'CategoriaController@destroy', 'as' => 'Categoria.destroy']);


Route::post('bartender/pedido', 'BartenderController@pedido');
Route::get('bartender/tabla', 'BartenderController@mostrarTabla');
Route::resource('bartender', 'BartenderController');

Route::resource('cajero', 'CajeroController');
Route::post('cajero/recibo', 'CajeroController@recibo');
Route::post('cajero/edit', 'CajeroController@edit');

Route::get('mesero/venta',  'MeseroController@venta');
Route::get('mesero/disminuir',  'MeseroController@disminuir');
Route::get('mesero/agregar',  'MeseroController@agregar');
Route::resource('mesero', 'MeseroController');

Route::get('mesas/eliminar','MesasController@eliminar');
Route::get('mesas/edit', 'MesasController@edit');
Route::post('mesas/create', 'MesasController@create');
Route::resource('mesas', 'MesasController');

Route::resource('WelcomeAdmin', 'welcomeAdmin', ['only' => [
    'index']]);

Route::resource('WelcomeTrabajador', 'WelcomeTrabajadorController', ['only' => [
    'index']]);

Route::get('Auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('Auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

