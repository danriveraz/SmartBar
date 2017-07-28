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
use Auth;

class ContieneController extends Controller
{
  public function index(Request $request){

    session_start();
    $idProducto = $_SESSION['idProducto'];

    $insumos = Insumo::lists('nombre','id');
    $contienen = Contiene::IdProducto($idProducto)->
                           orderBy('idInsumo','ASC')->
                           paginate(20);
    $insumosDisponibles = Insumo::Search($request->nombre)->
                          Type($request->tipo)->
                          orderBy('id','ASC')->
                          paginate(20);
    return view('contiene.index')->with('insumos',$insumos)->
                                   with('contienen',$contienen)->
                                   with('insumosDisponibles',$insumosDisponibles)->
                                   with('idProducto',$idProducto);
  }

  public function create(Request $request){
    $insumosDisponibles = Insumo::Search($request->nombre)->
                       Type($request->tipo)->
                       orderBy('id','ASC')->
                       paginate(20);
    return view('contiene.create')->with('insumosDisponibles',$insumos);
  }

  public function store(Request $request){
    session_start();
    $idProducto = $_SESSION['idProducto'];
    $contiene = new Contiene;
    $contiene->idProducto = $idProducto;
    $contiene->idInsumo = $request->idInsumo;
    $contiene->cantidad = $request->cantidad;
    $contiene->idAdmin = 1;//Auth::id();
    $contiene->save();
    Flash::success("El insumo se ha agregado al producto")->important();
    return redirect()->route('contiene.index');
  }

  public function show($id){}

  public function edit($id){}

  public function destroy($id){
    $contiene = Contiene::find($id);
    $contiene->delete();
    Flash::success('El insumo ha sido retirado del producto.')->important();
    return redirect()->route('contiene.index');
  }

  public function agregar(Request $request){
    $idInsumo = $request->idI;
    $cantidad = $request->cant;
    session_start();
    $idProducto = $_SESSION['idProducto'];
    $contiene = new Contiene;
    $contiene->idProducto = $idProducto;
    $contiene->idInsumo = $idInsumo;
    $contiene->cantidad = $cantidad;
    $contiene->idAdmin = 1;//Auth::id();
    $contiene->save();
  }

  public function eliminar(Request $request){
    session_start();
    $idProducto = $_SESSION['idProducto'];
    $contiene = Contiene::IdProducto($idProducto)->IdInsumo($request->idI)->Cantidad($request->cant)->get();
    $contiene->delete();
  }
}
