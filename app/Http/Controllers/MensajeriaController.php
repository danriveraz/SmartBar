<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Usuario;
use PocketByR\Mensaje;
//use PocketByR\Carrito;
use PocketByR\User;


class MensajeriaController extends Controller
{
	public function __construct(){

	}
    public function index(){
			$mensajes = Mensaje::where('id_receptor',Auth::user()->id)->orwhere('id_emisor',Auth::user()->id)->get();
	    $usuarios = Usuario::where('id',Auth::user()->id)->get();
	    return view('Mensajes/index')->with('mensajes', $mensajes)->with('usuarios', $usuarios);
    }

		public function modificarEstado(Request $request){
			//$mensaje->estado=1;
			$mensaje = Mensaje::find($request->id);
			$mensaje->estado = $request->estado;
			$mensaje->save();
		}

}
