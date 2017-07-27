<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Proveedor;
use Laracasts\Flash\Flash;
use PocketByR\Insumo;
use Auth;

class ProveedorController extends Controller
{
    public function index(Request $request){

      $proveedores = Proveedor::Search($request->nombre)->
                         //where('idAdmin' , Auth::id())->
                         orderBy('id','ASC')->
                         paginate(20);
      return view('proveedor.index')->with('proveedores',$proveedores);	
	}

	public function create(){

    return view('proveedor.create');

  	}

  	public function store(Request $request){
      $proveedor = new Proveedor;
      $proveedor->nombre = $request->nombre;
      $proveedor->direccion = $request->direccion;
      $proveedor->telefono = $request->telefono;
      $proveedor->idAdmin = 8;//Auth::id();
      $proveedor->save();
      Flash::success("El proveedor se ha registrado satisfactoriamente")->important();
      return redirect()->route('proveedor.index');
  	}

  	public function show($id){

  	}

  	public function edit($id){
    	$proveedor = Proveedor::find($id);
    	return view('proveedor.edit')->with('proveedor',$proveedor);
  	}

  	public function update(Request $request, $id){
  		$proveedor = Proveedor::find($id);
    	$proveedor->nombre = $request->nombre;
    	$proveedor->direccion = $request->direccion;
    	$proveedor->telefono = $request->telefono;
    	$proveedor->idAdmin = Auth::id();
    	$proveedor->save();
    	flash::warning('El proveedor ha sido modificado satisfactoriamente')->important();
    	return redirect()->route('proveedor.index');
  	}

  	public function destroy($id){
    	$proveedor = Proveedor::find($id);
    	$proveedor->delete();
    	Flash::success('El proveedor ha sido eliminado de forma exitosa')->important();
    	return redirect()->route('proveedor.index');
    }
}
