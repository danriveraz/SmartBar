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
        if (!$userActual->esAdmin) {
            flash('No Tiene Los Permisos Necesarios')->error()->important();
            return redirect('/WelcomeTrabajador')->send();
        }

    }
    public function index(Request $request){
        $userActual = Auth::user();
        $mesas = Mesa::mesasAdmin($userActual->idEmpresa)->get();
    	return view('mesas.inicio')->with('mesas',$mesas);
    } 
    public function create(Request $request){
        $userActual = Auth::user();
        $cantidadActualMesas = Mesa::calculaCantidad($userActual->idEmpresa);
        if(sizeof($cantidadActualMesas) == 0) $cantidadActualMesas = 0;
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
        return view('mesas.inicio')->with('mesas',$mesas);
    }    
    public function edit(Request $request){
        dd("Jelou");
    }    
}
