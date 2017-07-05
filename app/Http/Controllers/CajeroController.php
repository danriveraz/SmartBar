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
        $mesas = Factura::buscarFactura($request->id)
                            ->paginate(20);                         
        $elementos = Venta::listarElementos($request->id)
                            ->paginate(20);
        return view('cajero.recibo')->with('mesas',$mesas)->with('elementos',$elementos);
    }
    public function show($id){

    }
}
