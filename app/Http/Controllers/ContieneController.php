<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Insumo;
use PocketByR\Producto;
use PocketByR\Contiene;
use Laracasts\Flash\Flash;

class ContieneController extends Controller
{
  public function index(){
    $idProducto = $_GET['idProducto'];
    $insumos = Insumo::lists('nombre','id');
    $contienen = Contiene::Search($idProducto)->
                           orderBy('idInsumo','ASC')->
                           paginate(20);
    return view('contiene.index')->with('insumos',$insumos)->with('contienen',$contienen)->with('idProducto',$idProducto);
  }

  public function create(Request $request){
    $idProducto = $_GET['idProducto'];
  	$insumos = Insumo::Search($request->nombre)->
                       Type($request->tipo)->
                       orderBy('id','ASC')->
                       paginate(20);
  	return view('contiene.create')->with('insumos',$insumos)->with('idProducto',$idProducto);
  }

  public function store(Request $request){
  	$contiene = new Contiene;
  	$contiene->idProducto = $_GET['idProducto'];
  	$contiene->idInsumo = $_GET['idProducto'];
  	$contiene->cantidad = $request->cantidad;
  	$contiene->idAdmin = 4;
  	$contiene->save();
  	Flash::success("El insumo se ha agregado al producto")->important();
    return redirect()->route('auth.contiene.index', ['idProducto'=>$_GET['idProducto']]);
  }

  public function show($id){}

  public function edit($id){}

  public function destroy($id){}
}
