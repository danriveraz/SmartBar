<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Factura;
use PocketByR\Venta;
use PocketByR\Mesa;
use PocketByR\CLiente;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class CajeroController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $userActual = Auth::user();
        if($userActual != null){
            if (!$userActual->esCajero) {
                flash('No Tiene Los Permisos Necesarios')->error()->important();
                return redirect('/WelcomeTrabajador')->send();
            }
        }   

    }
    public function index(Request $request){
        $userActual = Auth::user();
        $idFacturas = Factura::listarFacturaDia($userActual->empresaActual)->get();
        $ventas = Venta::vendido($idFacturas)->get();
        $totalVentas = 0;
        foreach ($ventas as $venta ) {
            $totalVentas = $totalVentas + ($venta->producto->precio * $venta->cantidad);
        }
        $facturas = Factura::buscarFacturas(Auth::user()->empresaActual)->get(); 
        $productos = array();
        for($i=0; $i < sizeof($facturas); $i++){
            $ventasHechas = $facturas[$i]->ventasHechas;
            for($j=0; $j < sizeof($ventasHechas); $j++){
                array_push($productos, array(($facturas[$i]->id), $ventasHechas[$j]->id, $ventasHechas[$j]->producto->nombre, $ventasHechas[$j]->cantidad, $ventasHechas[$j]->producto->precio, $ventasHechas[$j]->estadoMesero, $ventasHechas[$j]->estadoCajero)); 
            }
        }
    	return view('Cajero.inicio')->with('totalVentas',$totalVentas)->with('facturas',$facturas)->with('user',$userActual)->with('productos',$productos);
    }
    
    public function historial(Request $request){
      $facturas = Factura::listarTodas(Auth::user()->empresaActual)->get();
      return view('Cajero.historial')->with('facturas',$facturas);
    }
    public function show($id){

    }
     public function edit(Request $request){
       if($request->nombre != "" && $request->nit != "" && $request->telefono != "" && $request->mail != "" && $request->direccion != ""){
           $cliente = new Cliente();
           $cliente->nombre = $request->nombre;
           $cliente->nit = $request->nit;
           $cliente->telefono = $request->telefono;
           $cliente->email = $request->mail;
           $cliente->direccion = $request->direccion;
           $cliente->save();
       }

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
        $busqueda1 = Venta::ListarPendientesValidacion1($request->idFactura)->get();
        $busqueda2 = Venta::ListarPendientesValidacion2($request->idFactura)->get();
        if ((sizeof($busqueda1) == 0) && (sizeof($busqueda2) == 0)){
            Factura::actualizarFactura($request->idFactura);
            $factura = Factura::find($request->idFactura);
            Mesa::actualizarEstado($factura->mesa->id);
        }
        return redirect("cajero");
       
    }
}
