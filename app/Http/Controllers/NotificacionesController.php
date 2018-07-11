<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use PocketByR\Notificaciones;
use Auth;


class NotificacionesController extends Controller
{
    public function __construct(){

	}

    public function modificarNotificacion(Request $request, $id){

		$usuario = Auth::user();
		$notificacion = Notificaciones::find($id);
		if($notificacion->estado == 'nueva'){
			$notificacion->estado = "vieja";
			$notificacion->save();
		}
		//Redireccionamiento
		if($notificacion->ruta == "perfil"){
			$tab = 'perfil';
			return redirect()->route('Auth.usuario.editUsuario',$tab);
		}
	}
}
