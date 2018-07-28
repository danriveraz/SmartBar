<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use PocketByR\Insumo;
use PocketByR\Proveedor;
use PocketByR\Producto;
use PocketByR\Categoria;
use PocketByR\Contiene;
use Laracasts\Flash\Flash;
use PocketByR\Notificaciones;
use Carbon\Carbon;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Book;

class InsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $userActual = Auth::user();
        if($userActual != null){
          if (!$userActual->esAdmin) {
              flash('No Tiene Los Permisos Necesarios')->error()->important();
              return redirect('/WelcomeTrabajador')->send();
          }
        }

    }

    public function index(Request $request){

      $notificaciones = Notificaciones::Usuario(Auth::id())->get();
      $nuevas = 0;
      $fechaActual = Carbon::now()->subHour(5);
      $fecha2array = array();
      for ($i=0; $i < sizeof($notificaciones); $i++) { 
        if($notificaciones[$i]->estado == "nueva"){
          $nuevas = $nuevas + 1;
        }
        $fechaNotificacion = Carbon::parse($notificaciones[$i]->fecha);
        $diferencia = $fechaActual->diffInDays($fechaNotificacion,true);
        array_push($fecha2array, array($notificaciones[$i]->id, $diferencia));
      }

    
      $userActual = Auth::user();
      $categorias = Categoria::where('idEmpresa' , $userActual->empresaActual)->get();

      $proveedores = Proveedor::where('idEmpresa' , $userActual->empresaActual)->get();

      $insumos = Insumo::where('idEmpresa' , $userActual->empresaActual)->orderBy('nombre','ASC')->get();

      return view('Insumo.index')->with('insumos',$insumos)->
                                   with('categorias',$categorias)->
                                   with('proveedores',$proveedores)->
                                   with('nuevas', $nuevas)->
                                   with('notificaciones',$notificaciones)->
                                   with('fecha2array',$fecha2array);
  }

  public function modificar(Request $request){
    $userActual = Auth::user();
    $insumo = Insumo::find($request->id);
    $nombre = $insumo->nombre;
    $insumo->idProveedor = $request->proveedor;
    $insumo->nombre = $request->nombre;
    $insumo->marca = $request->marca;
    $insumo->cantidadUnidad = $request->unidades;
    $insumo->precioUnidad = $request->venta;
    $insumo->valorCompra = $request->compra;
    $insumo->medida = $request->medida;
        
    $insumo->cantidadMedida = $request->cantMedida;
    $insumo->cantidadRestante = $request->cantMedida*$request->unidades;

    if($insumo->tipo != $request->tipo){
      $insumo->tipo = $request->tipo;
      if($request->tipo == 1){
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->venta;
        $producto->idCategoria = $request->categoria;
        $producto->idEmpresa = $userActual->empresaActual;
        $producto->save();
        
        $contiene = new Contiene;
        $contiene->idProducto = $producto->id;
        $contiene->idInsumo = $insumo->id;
        $contiene->cantidad = $insumo->cantidadMedida;
        $contiene->idEmpresa = $userActual->empresaActual;
        $contiene->save();
      }else{
        $producto = Producto::Nombre($nombre)->where('idEmpresa',$userActual->empresaActual)->first();
        $contenido = Contiene::IdProducto($producto->id)->get();
        foreach($contenido as $contiene){
          $contiene->delete();
        }
        $producto->delete();
      }
    }
    else if($request->tipo == 1){
      $producto = Producto::Nombre($nombre)->where('idEmpresa',$userActual->empresaActual)->first();
      $producto->nombre = $request->nombre;
      $producto->precio = $request->venta;
      $producto->idCategoria = $request->categoria;
      $contiene = Contiene::IdProducto($producto->id)->IdInsumo($insumo->id)->first();
      $contiene->cantidad = $insumo->cantidadMedida;
      $contiene->save();
      $producto->save();
    }
    $insumo->save();
  }

  public function eliminar(Request $request){
    $contiene = Contiene::IdInsumo($request->id)->get();
    foreach ($contiene as $key => $value) {
      $producto = Producto::find($value->idProducto);
      $value->delete();
      $ingredientes = Contiene::idProducto($producto->id)->get();
      if(count($ingredientes) == 0){
        $producto->eliminado = 1;
        $producto->save();
      }
    }

    $insumo = Insumo::find($request->id);
    $insumo->eliminado = 1;
    $insumo->save();
  }

  public function store(Request $request){
      $userActual = Auth::user();
      $insumo = new Insumo;
      $insumo->idProveedor = $request->input('proveedores');
      $insumo->nombre = $request->nombre;
      $insumo->cantidadUnidad = $request->cantidadUnidad;
      $insumo->precioUnidad = $request->precioUnidad;
      $insumo->valorCompra = $request->valorCompra;

      if(empty($request->marca)){
        $insumo->marca = 'Sin marca';
      }else{
        $insumo->marca = $request->marca;
      }

      if ($request->medida == 'ml' || $request->medida == 'cm3') {
        $insumo->medida = false;
        $insumo->cantidadMedida = $request->cantidadMedida*0.033814;
        $insumo->cantidadRestante = ($request->cantidadMedida*0.033814)*$request->cantidadUnidad;
      }
      elseif ($request->medida == 'cl'){
        $insumo->medida = false;
        $insumo->cantidadMedida = $request->cantidadMedida*0.33814;
        $insumo->cantidadRestante = ($request->cantidadMedida*0.33814)*$request->cantidadUnidad;
      }
      elseif ($request->medida == 'unidad') {
        $insumo->medida = true;
        $insumo->cantidadMedida = 1;
        $insumo->cantidadRestante = $request->cantidadUnidad;
      }
      else{
        $insumo->medida = false;
        $insumo->cantidadMedida = $request->cantidadMedida;
        $insumo->cantidadRestante = $request->cantidadMedida*$request->cantidadUnidad;
      }

      if($request->tipo == null){
        $insumo->tipo = false;
      }
      else{
        $insumo->tipo = true;
      }

      $insumo->idEmpresa = $userActual->empresaActual;
      $insumos = Insumo::where('idEmpresa' , $userActual->empresaActual)->
                                lists('nombre','id');
      if(sizeof($insumos) == 0){
        $userActual->estadoTut += 1;
        $userActual->save();
      }
      $insumo->save();

      $userActual = Auth::user();
      if($insumo->tipo){
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precioUnidad;
        $producto->idCategoria = $request->input('categorias');
        $producto->idEmpresa = $userActual->empresaActual;
        $productos = Producto::where('idEmpresa' , $userActual->empresaActual)->
                                lists('nombre','id');
        if(sizeof($productos) == 0){
          $userActual->estadoTut += 3;
          $userActual->save();
        }
        $producto->save();

        $contiene = new Contiene;
        $contiene->idProducto = $producto->id;
        $contiene->idInsumo = $insumo->id;
        $contiene->cantidad = $insumo->cantidadMedida;
        $contiene->idEmpresa = $userActual->empresaActual;
        $contiene->save();
      }
      Flash::success("El insumo se ha registrado satisfactoriamente")->important();
      return redirect()->route('insumo.index');
  }

  public function import(Request $request){
    Excel::load('public/plantilla.xlsx', function($reader) {
      foreach ($reader->get() as $row) {
        $insumo = new Insumo;
        $insumo->cantidadUnidad = $row->und;
        $insumo->nombre = $row->nombre;

        $insumo->save();
      }
    })->get();
  }

  public function show($id){

  }

  public function edit($id){
    
  }

    public function update(Request $request, $id){

    }

    public function destroy($id){
      
    }
}