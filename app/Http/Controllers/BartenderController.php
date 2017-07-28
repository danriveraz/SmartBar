<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Venta;
use PocketByR\Factura;
use PocketByR\Mesa;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class BartenderController extends Controller
{
    //
    public function index(Request $request){
      $facturas = Factura::Listar2()
                  ->paginate(20);
    	return view('bartender.inicio')->with('facturas',$facturas);
    }
    public function store(Request $request){
      $pedidos = $request->pedidos;
      if (sizeof($pedidos) > 0) {
        Venta::actualizar($pedidos);
        $busqueda = Venta::ListarPendientes($request->idFactura)->paginate(20);
        if (sizeof($busqueda) == 0){
            Factura::actualizarFactura($request->idFactura);
            $factura = Factura::find($request->idFactura);
            Mesa::actualizarEstado($factura->mesa->id);
        }
      }
      $facturas = Factura::Listar2()
                  ->paginate(20);
      return view('bartender.inicio')->with('facturas',$facturas); 
    }
}
