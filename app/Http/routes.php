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
Route::get('inslistall/{page?}', 'insumoController@listall');
Route::resource('insumo', 'insumoController');

Route::get('producto/modificar', 'ProductoController@modificar');
Route::resource('producto', 'productoController');
Route::get('prodlistall', 'productoController@listall');
Route::get('producto/{id}/insumoedit', ['uses' => 'ProductoController@insumoedit', 'as' => 'producto.insumoedit']);

Route::get('contiene/eliminar', 'ContieneController@eliminar');
Route::get('contiene/guardar', 'ContieneController@guardar');
Route::get('contlistall/{page?}','contieneController@listall');
Route::resource('contiene', 'contieneController');

Route::get('proveedor/eliminar','ProveedorController@eliminar');
Route::get('proveedor/modificar','ProveedorController@modificar');
Route::get('provlistall/{page?}', 'proveedorController@listall');
Route::get('provlistall/{nombre?}', 'proveedorController@buscar');
Route::resource('proveedor', 'proveedorController');

Route::resource('categoria', 'categoriaController');
Route::get('catlistall', 'categoriaController@listall');
Route::get('categoria/{id}/destroy', ['uses' => 'CategoriaController@destroy', 'as' => 'categoria.destroy']);


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

Route::post('mesas/edit', 'MesasController@edit');
Route::post('mesas/create', 'MesasController@create');
Route::resource('mesas', 'MesasController');

Route::resource('WelcomeAdmin', 'welcomeAdmin', ['only' => [
    'index']]);

Route::resource('WelcomeTrabajador', 'WelcomeTrabajadorController', ['only' => [
    'index']]);


