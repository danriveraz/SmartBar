<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class MensajeController extends Controller
{



    public function store(Request $request){
      /*$userActual = Auth::user();
      $categoria = new Categoria;
      $categoria->nombre = $request->nombre;
      $categoria->precio = $request->precio;
      $categoria->idEmpresa = $userActual->idEmpresa;
      $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');
      if(sizeof($categorias) == 0){
        $userActual->estadoTut += 1;
        $userActual->save();
      }
      $categoria->save();*/
      Flash::success("La categoria se ha registrado satisfactoriamente")->important();
  	}
}
