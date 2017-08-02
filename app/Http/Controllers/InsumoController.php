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
        if (!$userActual->esAdmin) {
            flash('No Tiene Los Permisos Necesarios')->error()->important();
            return redirect('/WelcomeTrabajador')->send();
        }

    }

    public function index(Request $request){
      $userActual = Auth::user();
      $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');

      $proveedores = Proveedor::where('idEmpresa' , $userActual->idEmpresa)->
                                lists('nombre','id');

      return view('insumo.index',compact('proveedores'))->with('categorias',$categorias);
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
                         orderBy('id','ASC')->
                         paginate(15);

      return view('insumo.listall',compact('proveedores'))->with('insumos',$insumos)->with('categorias',$categorias);
  }


  public function store(Request $request){
      $userActual = Auth::user();
      $insumo = new Insumo;
      $insumo->idProveedor = $_POST['proveedores'];
      $insumo->nombre = $request->nombre;
      $insumo->marca = $request->marca;
      $insumo->cantidadUnidad = $request->cantidadUnidad;
      $insumo->precioUnidad = $request->precioUnidad;
      $insumo->valorCompra = $request->valorCompra;

      if ($request->medida == 'ml' || $request->medida == 'cm3') {
        $insumo->cantidadMedida = $request->cantidadMedida/30;
        $insumo->cantidadRestante = $request->cantidadMedida/30;
      }
      else{
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
      $insumo->save();

      if($insumo->tipo){
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precioUnidad;
        $producto->idCategoria = $_POST['categorias'];
        $producto->idAdmin = Auth::id();
        $producto->save();

        $contiene = new Contiene;
        $contiene->idProducto = $producto->id;
        $contiene->idInsumo = $insumo->id;
        $contiene->cantidad = $insumo->cantidadMedida;
        $contiene->idAdmin = Auth::id();
        $contiene->save();
      }
      Flash::success("El insumo se ha registrado satisfactoriamente")->important();
      return redirect()->route('insumo.index');
  }

  public function show($id){

  }

  public function edit($id){
    $userActual = Auth::user();
    $insumo = Insumo::find($id);

    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');
    $proveedores = Proveedor::where('idEmpresa' , $userActual->idEmpresa)->
                                lists('nombre','id');
    return view('insumo.edit')->with('insumo',$insumo)->with('proveedores',$proveedores)->with('categorias',$categorias);
  }

    public function update(Request $request, $id){
      $userActual = Auth::user();
  	  $insumo = Insumo::find($id);
      $insumo->idProveedor = $_POST['proveedores'];
      $insumo->nombre = $request->nombre;
      $insumo->marca = $request->marca;
      $insumo->cantidadUnidad = $request->cantidadUnidad;
      $insumo->precioUnidad = $request->precioUnidad;
      $insumo->valorCompra = $request->valorCompra;
      if ($request->medida == 'ml' || $request->medida == 'cm3') {
        $insumo->cantidadMedida = $request->cantidadMedida/30;
        $insumo->cantidadRestante = $request->cantidadMedida/30;
      }
      else{
        $insumo->cantidadMedida = $request->cantidadMedida;
        $insumo->cantidadRestante = $request->cantidadMedida;
      }
      if($request->tipo == '0'){
        $insumo->tipo = false;
      }
      else{
        $insumo->tipo = true;
      }
      $insumo->idEmpresa = $userActual->idEmpresa;
      $insumo->save();
      flash::warning('El insumo ha sido modificado satisfactoriamente')->important();
      return redirect()->route('insumo.index');
    }

    public function destroy($id){
      $insumo = Insumo::find($id);
      $insumo->delete();
      Flash::success('El insumo ha sido eliminado de forma exitosa')->important();
      return redirect()->route('insumo.index');
    }
}