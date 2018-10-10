<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Venta;
use Auth;
use PocketByR\Factura;
use PocketByR\Mesa;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class BartenderController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Permisos');
        $userActual = Auth::user();
        if($userActual != null){
         if (!$userActual->esBartender) {
            flash('No Tiene Los Permisos Necesarios')->error()->important();
            return redirect('/WelcomeTrabajador')->send();
          }
        }
    }
    //
    public function index(Request $request){
      $userActual = Auth::user();
      $facturas = Factura::Listar2($userActual->empresaActual)
                  ->get();
    	return view('Bartender.inicio')->with('facturas',$facturas);
    }
    public function edit(Request $request){
      $pedidos = $request->pedidos;
      if (sizeof($pedidos) > 0) {
        $id = Auth::user()->id;
        $arreglo = array($pedidos, $id, "idBartender");
        Venta::actualizarUsuario($arreglo);
        Venta::actualizar($pedidos);
        $busqueda1 = Venta::ListarPendientesValidacion1($request->idFactura)->get();
        $busqueda2 = Venta::ListarPendientesValidacion2($request->idFactura)->get();
        if ((sizeof($busqueda1) == 0) && (sizeof($busqueda2) == 0)){
            Factura::actualizarFactura($request->idFactura);
            $factura = Factura::find($request->idFactura);
            Mesa::actualizarEstado($factura->mesa->id);
        }
      }
      return redirect('bartender'); 
    }
    public function checkout(Request $request){
      $userActual = Auth::user();
      $facturas = Factura::Listar2($userActual->empresaActual)
                  ->get();
      $size = sizeof($facturas);
      return json_encode($size);
    }
}
