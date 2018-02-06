<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use PocketByR\Usuario;
use PocketByR\Mensaje;
use PocketByR\User;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function Mensajes(){
      $userActual = Auth::User();
			$mensajes = Mensaje::where('id_receptor',Auth::user()->id)->orwhere('id_emisor',Auth::user()->id)->get();
	    $usuarios = Usuario::where('id',Auth::user()->id)->get();
	    view()->share('mensajes', $mensajes);
      view()->share('usuarios', $usuarios);
    }
}
