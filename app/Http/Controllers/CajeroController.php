<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Factura;
use PocketByR\Venta;
use PocketByR\Mesa;
use PocketByR\Empresa;
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
        $empresa = Empresa::find($userActual->empresaActual);
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
    	return view('Cajero.inicio')->with('totalVentas',$totalVentas)->with('facturas',$facturas)->with('user',$userActual)->with('productos',$productos)->with('empresa', $empresa);
    }
  
    public function historial(Request $request){
      $facturas = Factura::listarTodas(Auth::user()->empresaActual)->get();
      $productos = array();
      $clientes = array();
      //dd($facturas[0]->cliente->nombre);
       for($i=0; $i < sizeof($facturas); $i++){
            $ventasHechas = $facturas[$i]->ventasHechas;
            for($j=0; $j < sizeof($ventasHechas); $j++){
                $idCLiente = 0;
                if($facturas[$i]->cliente != null){
                  $idCLiente = $facturas[$i]->cliente->id;
                }
                array_push($productos, array(($facturas[$i]->id), $ventasHechas[$j]->cantidad, $ventasHechas[$j]->producto->nombre, $ventasHechas[$j]->producto->precio, $ventasHechas[$j]->estadoMesero, $ventasHechas[$j]->obsequio, $idCLiente)); 
            }
            if($facturas[$i]->cliente != null){
               array_push($clientes, array($facturas[$i]->cliente->id, $facturas[$i]->cliente->nombre, $facturas[$i]->cliente->nit, $facturas[$i]->cliente->telefono, $facturas[$i]->cliente->email, $facturas[$i]->cliente->direccion1));
            }
        }
      return view('Cajero.historial')->with('facturas',$facturas)->with('productos',$productos)->with('clientes',$clientes);
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

      /* cambio para solucionar error -> Se encapsula todo dentro de un if
         con el fin de no realizar consultas sobre un id nulo, esto para evitar 
         errores cuando no hay ventas */
      /* inicio cambio */
      if($idProductos != null){
        foreach($idProductos as $id){
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
      }
      /* fin cambio */

        return redirect("cajero");
       
    }
}
