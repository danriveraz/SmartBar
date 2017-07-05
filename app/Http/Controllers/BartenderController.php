<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Venta;
use PocketByR\Factura;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class BartenderController extends Controller
{
    //
    public function index(Request $request){
    	return view('bartender.inicio');
    }
    public function store(Request $request){
      $pedidos = $request->pedidos;
      if (sizeof($pedidos) > 0) {
        Venta::actualizar($pedidos);
      }
      return view('bartender.inicio'); 
    }
    public function pedido(Request $request){
      $nombreMesa = $request->nombreMesa;
      $idFactura = $request->idFactura;
      $pedidos = Venta::Search()
                ->where('idFactura', '=', $idFactura)
                ->orderBy('hora','ASC')
                ->paginate(20);
      return view('bartender.pedido')->with('pedidos',$pedidos)->with('nombreMesa',$nombreMesa);
    }
    public function mostrarTabla(Request $request){
  		$mesas = Factura::Search()->
                       	paginate(20);
  		return view('bartender.tabla')->with('mesas',$mesas);
  	}
}
