<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Factura;
use PocketByR\Venta;
use PocketByR\Mesa;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class CajeroController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $userActual = Auth::user();
        if (!$userActual->esCajero) {
            flash('No Tiene Los Permisos Necesarios')->error()->important();
            return redirect('/WelcomeTrabajador')->send();
        }

    }
    public function index(Request $request){
    	$mesas = Factura::listar()
    						->paginate(20);
    	return view('Cajero.inicio')->with('mesas',$mesas);
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
    	return view('Cajero.inicio')->with('mesas',$mesas);
    }
    public function recibo(Request $request){
        $factura = Factura::find($request->id);
        return view('Cajero.recibo')->with('factura',$factura);
    }
    public function show($id){

    }
     public function edit(Request $request){
       $estadoProductos = $request->productos;
       $idProductos = $request->productosId;
       $estados =$request->estados;
       $contador = 0;
        foreach ($idProductos as $id) {
            $rq = array("$id", "$estados[$contador]");
            Venta::ActualizarVenta($rq);
            $contador = $contador + 1;
        }
        $idUsuario = Auth::user()->id;
        $arreglo = array($idProductos, $idUsuario, "idCajero");
        Venta::actualizarUsuario($arreglo);
        Factura::actualizarValor($request);
        $busqueda = Venta::ListarPendientes($request->idFactura)->paginate(20);
        if (sizeof($busqueda) == 0){
            Factura::actualizarFactura($request->idFactura);
            $factura = Factura::find($request->idFactura);
            Mesa::actualizarEstado($factura->mesa->id);
        }
        return redirect("cajero");
       
    }
}
