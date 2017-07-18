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
                                   with('insumosDisponibles',$insumosDisponibles);
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
    $contiene->idAdmin = Auth::id();
    $contiene->save();
    Flash::success("El insumo se ha agregado al producto")->important();
    return redirect()->route('contiene.index');
  }

  public function show($id){}

  public function edit($id){}

  public function destroy(Request $request,$id){
    $contiene = Contiene::IdInsumo($request->idInsumo);
    dd($contiene);
    $contiene->delete();
    Flash::success('La categoría ha sido eliminada de forma exitosa')->important();
    return redirect()->route('categoria.index');
  }
}
