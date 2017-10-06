<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Insumo;
use PocketByR\Proveedor;
use PocketByR\Producto;
use PocketByR\Categoria;
use PocketByR\Contiene;
use Laracasts\Flash\Flash;
use Auth;

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
      $userActual = Auth::user();
      $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');

      $proveedores = Proveedor::where('idEmpresa' , $userActual->idEmpresa)->
                                lists('nombre','id');

      return view('Insumo.index',compact('proveedores'))->with('categorias',$categorias);
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
    $insumo->cantidadRestante = $request->cantMedida;    

    if($insumo->tipo != $request->tipo){
      $insumo->tipo = $request->tipo;
      if($request->tipo == '1'){
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->venta;
        $producto->idCategoria = $request->categoria;
        $producto->idEmpresa = $userActual->idEmpresa;
        $producto->save();

        $contiene = new Contiene;
        $contiene->idProducto = $producto->id;
        $contiene->idInsumo = $insumo->id;
        $contiene->cantidad = $insumo->cantidadMedida;
        $contiene->idEmpresa = $userActual->idEmpresa;
        $contiene->save();        
      }else{
        $producto = Producto::Nombre($request->nombre)->first();
        $contenido = Contiene::IdProducto($producto->id)->get();
        foreach($contenido as $contiene){
          $contiene->delete();
        }
        $producto->delete();
      }
    }
    else if($request->tipo == '1'){
      $producto = Producto::Nombre($nombre)->first();
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
    $insumo = Insumo::find($request->id);
    $insumo->delete();
  }

  public function listall(Request $request){

    $userActual = Auth::user();
      $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');

      $proveedores = Proveedor::where('idEmpresa' , $userActual->idEmpresa)->
                                lists('nombre','id');

      $insumos = Insumo::Search($request->nombre,$request->marca)->
                         Type($request->tipo)->
                         where('idEmpresa' , $userActual->idEmpresa)->
                         orderBy('nombre','ASC')->
                         paginate(1000);

      return view('Insumo.listall',compact('proveedores'))->with('insumos',$insumos)->with('categorias',$categorias);
  }


  public function store(Request $request){
      $userActual = Auth::user();
      $insumo = new Insumo;
      $insumo->idProveedor = $_POST['proveedores'];
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
        $insumo->cantidadMedida = $request->cantidadMedida/30;
        $insumo->cantidadRestante = $request->cantidadMedida/30;
      }
      elseif ($request->medida == 'unidad') {
        $insumo->cantidadUnidad = 1;
        $insumo->medida = true;
        $insumo->cantidadMedida = $request->cantidadMedida;
        $insumo->cantidadRestante = $request->cantidadMedida;
      }
      else{
        $insumo->medida = false;
        $insumo->cantidadMedida = $request->cantidadMedida;
        $insumo->cantidadRestante = $request->cantidadMedida;
      }

      if($request->tipo == null){
        $insumo->tipo = false;
      }
      else{
        $insumo->tipo = true;
      }

      $insumo->idEmpresa = $userActual->idEmpresa;
      $insumos = Insumo::where('idEmpresa' , $userActual->idEmpresa)->
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
        $producto->idCategoria = $_POST['categorias'];
        $producto->idEmpresa = $userActual->idEmpresa;
        $productos = Producto::where('idEmpresa' , $userActual->idEmpresa)->
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
        $contiene->idEmpresa = $userActual->idEmpresa;
        $contiene->save();
      }
      Flash::success("El insumo se ha registrado satisfactoriamente")->important();
      return redirect()->route('insumo.index');
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