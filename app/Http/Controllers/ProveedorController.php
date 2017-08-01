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
      return view('proveedor.index');
	  }

    public function listall(Request $request){
      $userActual = Auth::user();
      $proveedores = Proveedor::Search($request->nombre)->
                         where('idEmpresa' , $userActual->idEmpresa)->
                         orderBy('id','ASC')->
                         paginate(2);
      return view('proveedor.listall')->with('proveedores',$proveedores);
    }

    public function buscar(Request $request){
      $userActual = Auth::user();
      $proveedores = Proveedor::Search($request->nombre)->
                         where('idEmpresa' , $userActual->idEmpresa)->
                         orderBy('id','ASC')->
                         paginate(2);
      return view('proveedor.listall')->with('proveedores',$proveedores);
    }

  	public function store(Request $request){
      $userActual = Auth::user();
      $proveedor = new Proveedor;
      $proveedor->nombre = $request->nombre;
      $proveedor->direccion = $request->direccion;
      $proveedor->telefono = $request->telefono;
      $proveedor->idEmpresa = $userActual->idEmpresa;
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
      $userActual = Auth::user();
  		$proveedor = Proveedor::find($id);
    	$proveedor->nombre = $request->nombre;
    	$proveedor->direccion = $request->direccion;
    	$proveedor->telefono = $request->telefono;
    	$proveedor->idEmpresa = $userActual->idEmpresa;
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
