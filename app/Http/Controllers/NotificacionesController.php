<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\User;
use PocketByR\Notificaciones;
use Auth;
use Carbon\Carbon;


class NotificacionesController extends Controller
{
    public function __construct(){

	}

	public function index(){

		$usuario = Auth::user();
		$notificaciones = Notificaciones::Usuario($usuario->id)->get();
        $nuevas = 0;
        $fechaActual = Carbon::now();
        $fecha2array = array();
        for ($i=0; $i < sizeof($notificaciones); $i++) { 
          if($notificaciones[$i]->estado == "nueva"){
            $nuevas = $nuevas + 1;
          }
          $fechaNotificacion = Carbon::parse($notificaciones[$i]->fecha);
          $diferencia = $fechaActual->diffInDays($fechaNotificacion,true);
          array_push($fecha2array, array($notificaciones[$i]->id, $diferencia));
        }
        
        return View('Notificaciones/index')
                ->with('notificaciones',$notificaciones)
                ->with('nuevas',$nuevas)
                ->with('fecha2array',$fecha2array);
	}

    public function modificarNotificacion(Request $request, $id){

		$usuario = Auth::user();
		$notificacion = Notificaciones::find($id);
		if($notificacion->estado == 'nueva'){
			$notificacion->estado = "vieja";
			$notificacion->save();
		}
		//Redireccionamiento
		if($notificacion->ruta == "Perfil"){
			session_start();
			$_SESSION['id'] = $usuario->id;
	        $tab = 'perfil';
	        return redirect()->route('Auth.usuario.editUsuario',$tab);
		}
	}
}
