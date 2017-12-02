<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Mensaje;
use PocketByR\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Auth;

class MensajeController extends Controller
{
  public function __construct()
  {

  }

  public function store(Request $request){
    $userActual = Auth::user()->id;
    $mensaje = new Mensaje;
    $mensaje->id_emisor = $userActual;
    $mensaje->id_receptor = $request->id_receptor;
    $mensaje->asunto = $request->asunto;
    $mensaje->descripcion = $request->descripcion;

    $mensaje->save();


    Flash::success("El mensaje se ha enviado satisfactoriamente")->important();
    return redirect()->route('Auth.usuario.index');
  }
}
