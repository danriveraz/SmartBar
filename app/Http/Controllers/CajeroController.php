<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Factura;
use PocketByR\Venta;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class CajeroController extends Controller
{
    public function index(Request $request){
    	$mesas = Factura::listar()
    						->paginate(20);
    	return view('cajero.inicio')->with('mesas',$mesas);
    }
    public function store(Request $request){
    	$nombre = $request->nombre;
    	if($request->verFacturas == 'on'){
    		$mesas = Factura::buscarMesa($nombre)
    					->paginate(20);
    	}
    	else{
    		$mesas = Factura::buscarMesaEnProceso($nombre)
    					->paginate(20);
    	}
    	return view('cajero.inicio')->with('mesas',$mesas);
    }
    public function recibo(Request $request){
        $factura = Factura::find($request->id);
        return view('cajero.recibo')->with('factura',$factura);
    }
    public function show($id){

    }
     public function edit(Request $request){
       $productos = $request->productos;
       if (sizeof($productos) > 0) {
            Venta::actualizarVenta($productos);
        }
        Factura::actualizarValor($request);
        $busqueda = Venta::ListarPendientes($request->idFactura)->paginate(20);
        $contador = 0;
        if (sizeof($busqueda) == 0){
            Factura::actualizarFactura($request->idFactura);
        }
        return redirect("cajero");
    }
}
