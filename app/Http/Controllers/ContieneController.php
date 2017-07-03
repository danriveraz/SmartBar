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
   }

  	public function create(Request $request){
  		$insumos = Insumo::Search($request->nombre)->
                       Type($request->tipo)->
                       orderBy('id','ASC')->
                       paginate(20);
  		return view('contiene.create')->with('insumos',$insumos);
  	}
  	public function store(Request $request,$idInsumo){
  		$producto = Producto::orderBy('idProducto','DESC')->take(1)->get();
  		$contiene = new Contiene;
  		$contiene->idProducto = $producto->idProducto;
  		$contiene->idInsumo = $idInsumo;
  		$contiene->cantidad = $request->cantidadUnidad;
  		$contiene->idAdmin = 1;
  		$contiene->save();
  		Flash::success("El insumo se ha agregado al producto")->important();
    	return redirect()->route('auth.contiene.create');
  	}

  	public function show($id){}

  	public function edit($id){}

  	public function destroy($id){}
}
