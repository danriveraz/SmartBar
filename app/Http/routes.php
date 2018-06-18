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
Route::get('/zohoverify/verifyforzoho.html', 'HomeController@prueba');

Route::get('/preguntasFrecuentes', 'HomeController@preguntasFrecuentes');

Route::get('/AmigoInseparable', 'HomeController@AmigoInseparable');

Route::get('/PocketClub', 'HomeController@PocketClub');

Route::get('/politicas', 'HomeController@politicas');

Route::get('/contactos', 'HomeController@contactos');


Route::get('Auth/register', 'Auth\AuthController@getRegister');
Route::post('Auth/register', 'Auth\AuthController@postRegister');

Route::get('Auth/cambiarBar', 'Auth\AuthController@cambiarBar');

Route::get('Auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');


Route::get('Auth/login', 'Auth\AuthController@getLogin');
Route::post('Auth/login', 'Auth\AuthController@postLogin');
Route::get('Auth/logout', 'Auth\AuthController@getLogout');


Route::get('Auth/resetpassword', 'Auth\AuthController@resetpassword');
Route::get('Auth/profile', 'Auth\AuthController@profile');
Route::get('Auth/editProfile' , 'Auth\AuthController@editProfile');
Route::post('Auth/updateProfile', 'Auth\AuthController@updateProfile');
Route::post('Auth/updateFactura', 'Auth\AuthController@updateFactura');

Route::group(['prefix' => 'Auth'], function(){
  Route::post('registerUser', 'UsuariosController@registerUser');
  Route::post('modificarEmpresa', ['uses' => 'UsuariosController@postmodificarEmpresa', 'as' => 'Auth.usuario.editEmpresa']);
  Route::get('modificarEmpresa', ['uses' => 'UsuariosController@modificarEmpresa', 'as' => 'Auth.usuario.showeditEmpresa']);
  Route::post('modificarFactura', ['uses' => 'UsuariosController@postmodificarFactura', 'as' => 'Auth.usuario.editFactura']);
  Route::get('modificarFactura', ['uses' => 'UsuariosController@modificarFactura', 'as' => 'Auth.usuario.showeditFactura']);
  Route::resource('usuario','UsuariosController');

  Route::get('usuario/{id}/edit', ['uses' => 'UsuariosController@edit', 'as' => 'Auth.usuario.edit']);
  Route::get('editarUsuairo', ['uses' => 'UsuariosController@editProfile', 'as' => 'Auth.usuario.editUsuario']);
  Route::get('editarUsuairo/{id}/edit', ['uses' => 'UsuariosController@posteditProfile', 'as' => 'Auth.usuario.posteditUsuario']);

  Route::get('usuario/{id}/destroy', ['uses' => 'UsuariosController@destroy', 'as' => 'Auth.usuario.destroy']);
  Route::get('usuario/{id}/active', ['uses' => 'UsuariosController@cambiarEstado', 'as' => 'Auth.usuario.cambiarEstado']);
  Route::post('verificarUser', 'UsuariosController@verificarUser');
});

Route::get('insumo/eliminar', 'InsumoController@eliminar');
Route::get('insumo/modificar', 'InsumoController@modificar');
Route::resource('insumo', 'InsumoController');

Route::get('producto/recetas', 'ProductoController@recetas');
Route::get('producto/ingredientes', 'ProductoController@ingredientes');
Route::get('producto/eliminar', 'ProductoController@eliminar');
Route::get('producto/modificar', 'ProductoController@modificar');
Route::resource('producto', 'ProductoController');
Route::get('prodlistall', 'ProductoController@listall');
Route::get('producto/{id}/contenido', ['uses' => 'ProductoController@contenido', 'as' => 'producto.contenido']);

Route::get('contiene/eliminar', 'ContieneController@eliminar');
Route::get('contiene/guardar', 'ContieneController@guardar');
Route::get('contlistall/{page?}','ContieneController@listall');
Route::resource('contiene', 'ContieneController');

Route::get('proveedor/eliminar','ProveedorController@eliminar');
Route::get('proveedor/modificar','ProveedorController@modificar');
Route::get('provlistall/{page?}', 'ProveedorController@listall');
Route::get('provlistall/{nombre?}', 'ProveedorController@buscar');
Route::resource('proveedor', 'ProveedorController');

Route::get('categoria/eliminar','CategoriaController@eliminar');
Route::get('categoria/modificar', 'CategoriaController@modificar');
Route::resource('categoria', 'CategoriaController');
Route::get('catlistall', 'CategoriaController@listall');
Route::get('categoria/{id}/destroy', ['uses' => 'CategoriaController@destroy', 'as' => 'Categoria.destroy']);


//Route::post('bartender/pedido', 'BartenderController@pedido');
//Route::get('bartender/tabla', 'BartenderController@mostrarTabla');
//Route::resource('bartender', 'BartenderController');
Route::get('bartender/', 'BartenderController@index');
Route::post('bartender/edit', 'BartenderController@edit');
Route::get('bartender/checkout', 'BartenderController@checkout');

Route::resource('Estadisticas', 'EstadisticasController');

Route::post('cajero/edit', 'CajeroController@edit');
Route::get('cajero/', 'CajeroController@index');
Route::get('cajero/historial', 'CajeroController@historial');


Route::get('mesero/venta',  'MeseroController@venta');
Route::get('mesero/disminuir',  'MeseroController@disminuir');
Route::get('mesero/agregar',  'MeseroController@agregar');
Route::get('mesero/factura',  'MeseroController@factura');
Route::get('mesero/contiene',  'MeseroController@contiene');
Route::resource('mesero', 'MeseroController');


Route::get('mesas/eliminar','MesasController@eliminar');
Route::get('mesas/modificar', 'MesasController@modificar');
Route::get('mesaslistall/{page?}', 'MesasController@listall');
Route::post('mesas/create', 'MesasController@createNMesas');
Route::resource('mesas', 'MesasController');

Route::resource('WelcomeAdmin', 'welcomeAdmin', ['only' => [
    'index']]);

Route::resource('WelcomeTrabajador', 'WelcomeTrabajadorController', ['only' => [
    'index']]);

Route::resource('agenda', 'AgendaTrabajadoresController@index');

Route::get('Auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('Auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

// rutas apra registrar proveedores
Route::get('RegistrarProveedor', 'RegistrarProveedorController@registrarProveedor');// registrar el proveedor
Route::post('RegistrarProveedor', 'RegistrarProveedorController@postRegistrarProveedor');
Route::get('WelcomeProveedor', 'RegistrarProveedorController@index');

// rutas para el registro de entrada y salida de los usuarios, controlador regitroLoginController
Route::get('RegistroLogin/{id}', 'RegistroLoginController@show');// registrar el proveedor

Route::get('Tutorial' , ['uses' => 'UsuariosController@tutorial', 'as' => 'usuarios.tutorial']);



Route::resource('/usuario', 'MensajeController@store');
Route::resource('/usuario', 'MensajeController');

Route::resource('Tienda', 'TiendaController');
Route::resource('Salario','SalarioController');

Route::get('Mensajes/modificar', 'MensajeriaController@modificarEstado');
Route::resource('Mensajes', 'MensajeriaController');

Route::get('mail', function () { // esto lo hice para poder probar los emails
    $admin =  Auth::user();
    $data = ['user' => $admin, 'contrasena' => '1245678'];

    return view("Emails/confirmacionDatosTrabajador")->with('data',$data);
});
