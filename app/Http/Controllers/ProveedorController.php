<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Proveedor;
use Laracasts\Flash\Flash;
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

    public function eliminar(Request $request){
      $proveedor = Proveedor::find($request->id);
      $proveedor->delete();
    }    

    public function modificar(Request $request){
      $proveedor = Proveedor::find($request->id);
      $proveedor->nombre = $request->nombre;
      $proveedor->direccion = $request->direccion;
      $proveedor->telefono = $request->telefono;
      $proveedor->save();
    }     

    public function listall(Request $request){
      $userActual = Auth::user();
      $proveedores = Proveedor::Search($request->nombre)->
                         where('idEmpresa' , $userActual->idEmpresa)->
                         orderBy('id','ASC')->
                         paginate(5);
      return view('proveedor.listall')->with('proveedores',$proveedores);
    }

    public function buscar(Request $request){
      $userActual = Auth::user();
      $proveedores = Proveedor::Search($request->nombre)->
                         where('idEmpresa' , $userActual->idEmpresa)->
                         orderBy('id','ASC')->
                         paginate(15);
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

  	public function show($id){}

  	public function edit($id){}

  	public function update(Request $request, $id){}

  	public function destroy($id){}   
    
}
