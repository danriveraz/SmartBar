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
      $facturas = Factura::Listar2($userActual->idEmpresa)
                  ->get();
    	return view('Bartender.inicio')->with('facturas',$facturas);
    }
    public function store(Request $request){
      $pedidos = $request->pedidos;
      if (sizeof($pedidos) > 0) {
        $id = Auth::user()->id;
        $arreglo = array($pedidos, $id, "idBartender");
        Venta::actualizarUsuario($arreglo);
        Venta::actualizar($pedidos);
        $busqueda = Venta::ListarPendientes($request->idFactura)->paginate(20);
        if (sizeof($busqueda) == 0){
            Factura::actualizarFactura($request->idFactura);
            $factura = Factura::find($request->idFactura);
            Mesa::actualizarEstado($factura->mesa->id);
        }
      }
      $userActual = Auth::user();
      $facturas = Factura::Listar2($userActual->idEmpresa)
                  ->get();
      return view('Bartender.inicio')->with('facturas',$facturas); 
    }
}
