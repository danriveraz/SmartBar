<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Mesa;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class MesasController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $userActual = Auth::user();
        if($userActual != null){
            if (!$userActual->esAdmin) {
                flash('No Tiene Los Permisos Necesarios')->error()->important();
                return redirect('/WelcomeTrabajador')->send();
            }
        }

    }
    public function index(Request $request){
    	return view('Mesas.inicio');
    }
    public function create(Request $request){
        $userActual = Auth::user();
        $cantidadActualMesas = Mesa::calculaCantidad($userActual->idEmpresa);
        if(!is_int($cantidadActualMesas)) $cantidadActualMesas = 0;
        $cantidadActualMesas++;
        $mesa = new Mesa;
        $mesa->idMesa = $cantidadActualMesas;
        $mesa->nombreMesa = $request->nombre;
        $mesa->estado = $request->estado;
        $mesa->idEmpresa = $userActual->idEmpresa;
        $mesas = Mesa::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('id');
        if(sizeof($mesas) == 0){
            $userActual->estadoTut += 1;
            $userActual->save();
          }
        $mesa->save();
        return redirect('mesas');
    }
    public function createNMesas(Request $request){
        $userActual = Auth::user();
        $cantidadActualMesas = Mesa::calculaCantidad($userActual->idEmpresa);
        if(!is_int($cantidadActualMesas)) $cantidadActualMesas = 0;
        for ($i=0; $i < $request->cantidad; $i++) {
            $cantidadActualMesas++;
            $mesa = new Mesa;
            $mesa->idMesa = $cantidadActualMesas;
            $mesa->nombreMesa = "Mesa $cantidadActualMesas";
            $mesa->estado = "Disponible";
            $mesa->idEmpresa = $userActual->idEmpresa;
            $mesa->save();
        }
        $mesas = Mesa::mesasAdmin($userActual->idEmpresa)->get();
        return redirect('mesas')->with('mesas',$mesas);
    }
    public function modificar(Request $request){
        $mesa = Mesa::find($request->id);
        $mesa->nombreMesa = $request->nombre;
        $mesa->estado = $request->estado;
        $mesa->save();
    }

    public function listall(Request $request){
        $userActual = Auth::user();
        $id = $userActual->idEmpresa;
        $nombre = $request->nombre;
        $arreglo = array("$id", "$nombre");
        $mesas = Mesa::buscarMesas($arreglo)->get();
        return view('Mesas.listall')->with('mesas',$mesas);
    }

    public function store(Request $request){
        $userActual = Auth::user();
        $id = $userActual->idEmpresa;
        $nombre = $request->nombre;
        $arreglo = array("$id", "$nombre");
        $mesas = Mesa::buscarMesas($arreglo)->get();
        return view('Mesas.inicio')->with('mesas',$mesas);
    }
    public function eliminar(Request $request){
      $mesa = Mesa::find($request->id);
      $mesa->delete();
    }

}
