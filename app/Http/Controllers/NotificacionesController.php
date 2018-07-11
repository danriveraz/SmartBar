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

	public function index(){

		$usuario = Auth::user();
		$notificacionesAuxiliar = Notificaciones::Usuario($usuario->id)->get();
		$allNotifications = Notificaciones::Usuario($usuario->id)->get();
        $notificaciones[] = array();
        $nuevas = 0;

        for ($i=0; $i < sizeof($notificacionesAuxiliar); $i++) { 
          if($notificacionesAuxiliar[$i]->estado == "nueva"){
            $nuevas = $nuevas + 1;
          }
          if($i < 4){
            array_push($notificaciones, $notificacionesAuxiliar[$i]);
          }
        }
        
        array_shift($notificaciones);

        return View('Notificaciones/index')
                ->with('notificaciones',$notificaciones)
                ->with('nuevas',$nuevas)
                ->with('allNotifications',$allNotifications);

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
			session_start();
			$_SESSION['id'] = $usuario->id;
	        $tab = 'perfil';
	        return redirect()->route('Auth.usuario.editUsuario',$tab);
		}
	}
}
