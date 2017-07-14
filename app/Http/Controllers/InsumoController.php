<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Insumo;
use PocketByR\Proveedor;
use Laracasts\Flash\Flash;
use Auth;

class InsumoController extends Controller
{

    public function index(Request $request){
      $proveedores = Proveedor::where('idAdmin' , Auth::id())->
                                lists('nombre','id');

      $insumos = Insumo::Search($request->nombre)->
                         Type($request->tipo)->
                         where('idAdmin' , Auth::id())->
                         orderBy('id','ASC')->
                         paginate(20);

      return view('insumo.index',compact('proveedores'))->with('insumos',$insumos);
  }

  public function create(){

    $proveedores = Proveedor::where('idAdmin' , Auth::id())->
                              lists('nombre','id');

    return view('insumo.create')->with('proveedores',$proveedores);
  }

  public function store(Request $request){
      $insumo = new Insumo;
      $insumo->idProveedor = $_POST['proveedores'];
      $insumo->nombre = $request->nombre;
      $insumo->marca = $request->marca;
      $insumo->cantidadUnidad = $request->cantidadUnidad;
      $insumo->precioUnidad = $request->precioUnidad;
      $insumo->valorCompra = $request->valorCompra;
      if ($request->medida == 'ml' || $request->medida == 'cm3') {
        $insumo->cantidadMedida = $request->cantidadMedida/30;
      }
      else{
        $insumo->cantidadMedida = $request->cantidadMedida;
      }
      $insumo->tipo = $_POST['Tipo'];
      $insumo->idAdmin = Auth::id();
      $insumo->save();
      Flash::success("El insumo se ha registrado satisfactoriamente")->important();
      return redirect()->route('insumo.index');
  }

  public function show($id){

  }

  public function edit($id){
    $proveedores = Proveedor::lists('nombre','id');
    $insumo = Insumo::find($id);
    return view('insumo.edit')->with('insumo',$insumo)->with('proveedores',$proveedores);
  }

    public function update(Request $request, $id){
  	  $insumo = Insumo::find($id);
      $insumo->idProveedor = $_POST['proveedores'];
      $insumo->nombre = $request->nombre;
      $insumo->marca = $request->marca;
      $insumo->cantidadUnidad = $request->cantidadUnidad;
      $insumo->precioUnidad = $request->precioUnidad;
      $insumo->valorCompra = $request->valorCompra;
      if ($request->medida == 'ml' || $request->medida == 'cm3') {
        $insumo->cantidadMedida = $request->cantidadMedida/30;
      }
      else{
        $insumo->cantidadMedida = $request->cantidadMedida;
      }
      $insumo->tipo = $_POST['Tipo'];
      $insumo->idAdmin = Auth::id();
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