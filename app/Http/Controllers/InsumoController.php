<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Insumo;
use Laracasts\Flash\Flash;

class InsumoController extends Controller
{
    public function index(Request $request){
      $insumos = Insumo::Search($request->nombre)->
                       Type($request->tipo)->
                       Category($request->categoria)->
                       orderBy('id','ASC')->
                       paginate(20);
      return view('insumo.index')->with('insumos',$insumos);
  }

  public function create(){
    return view('insumo.create');
  }

  public function store(Request $request){
      $insumo = new Insumo;
      $insumo->idProveedor = $request->idProveedor;
      $insumo->nombre = $request->nombre;
      $insumo->cantidadUnidad = $request->cantidadUnidad;
      $insumo->precioUnidad = $request->precioUnidad;
      $insumo->valorCompra = $request->valorCompra;
      $insumo->cantidadMedida = $request->cantidadMedida;
      $insumo->tipo = $_POST['Tipo'];
      $insumo->categoria = $_POST['Categoria'];
      $insumo->idAdmin = 1;
      $insumo->save();
      Flash::success("El insumo se ha registrado satisfactoriamente")->important();
      return redirect()->route('insumo.index');
  }

  public function show($id){

  }

  public function edit($id){
    $insumo = Insumo::find($id);
    return view('insumo.edit')->with('insumo',$insumo);
  }

  public function update(Request $request, $id){
  	$insumo = Insumo::find($id);
    $insumo->idProveedor = $request->idProveedor;
    $insumo->nombre = $request->nombre;
    $insumo->cantidadUnidad = $request->cantidadUnidad;
    $insumo->precioUnidad = $request->precioUnidad;
    $insumo->valorCompra = $request->valorCompra;
    $insumo->cantidadMedida = $request->cantidadMedida;
    $insumo->tipo = $_POST['Tipo'];
    $insumo->categoria = $_POST['Categoria'];
    $insumo->idAdmin = 1;
    $insumo->save();
    flash::warning('El insumo ha sido modificado satisfactoriamente')->important();
    return redirect()->route('insumo.index');
  }

  public function destroy($id){
  }
}