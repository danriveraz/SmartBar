<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Insumo;
use PocketByR\Producto;
use PocketByR\Contiene;
use Laracasts\Flash\Flash;
use Auth;

class ContieneController extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
        $userActual = Auth::user();
        if($userActual != null){
          if (!$userActual->esAdmin) {
              flash('No Tiene Los Permisos Necesarios')->error()->important();
              return redirect('/WelcomeTrabajador')->send();
          }
        }
    }  
  public function index(Request $request){
    session_start();
    $idProducto = $_SESSION['idProducto'];
    $nombre = $_SESSION['nombre'];

    $insumos = Insumo::lists('nombre','id');

    $contienen = Contiene::IdProducto($idProducto)->
                           orderBy('idInsumo','ASC')->
                           paginate(50);

    return view('Contiene.index')->with('insumos',$insumos)->
                                   with('contienen',$contienen)->
                                   with('idProducto',$idProducto)->
                                   with('nombre',$nombre);
  }

  public function listall(Request $request){
    $userActual = Auth::user();
    session_start();
    $idProducto = $_SESSION['idProducto'];

    $insumos = Insumo::lists('nombre','id');

    $insumosDisponibles = Insumo::Search($request->nombre)->
                          where('idEmpresa' , $userActual->idEmpresa)->
                          Type($request->tipo)->
                          orderBy('nombre','ASC')->
                          paginate(1000);
                          
    return view('Contiene.listall')->with('insumos',$insumos)->
                                   with('insumosDisponibles',$insumosDisponibles)->
                                   with('idProducto',$idProducto);
  }

  public function create(Request $request){}

  public function store(Request $request){}

  public function show($id){}

  public function edit($id){}

  public function destroy($id){}

  public function eliminar(Request $request){
    $userActual = Auth::user();
    $idProducto = $request->idProducto;
    $idInsumo = $request->idInsumo; 
    $contieneAux = Contiene::IdProducto($idProducto)->
                             IdInsumo($idInsumo)->
                             where('idEmpresa',$userActual->idEmpresa)->first();
    if($contieneAux != null){
      $contieneAux->delete();
    }
  }

  public function guardar(Request $request){
    $userActual = Auth::user();
    $idProducto = $request->idProducto;
    $idInsumos = $request->insumos;
    $cantidades = $request->cantidades;

    $cantidadInsumos = sizeOf($idInsumos);

    if($cantidadInsumos != 0){
      for($i=0; $i<$cantidadInsumos; $i++){
        $contieneAux = Contiene::IdProducto($idProducto)->
                                 IdInsumo($idInsumos[$i])->
                                 where('idEmpresa',$userActual->idEmpresa)->first();
        if($contieneAux == null){
          $contiene = new Contiene;
          $contiene->idProducto = $idProducto;
          $contiene->idInsumo = $idInsumos[$i];
          $contiene->cantidad = $cantidades[$i];
          $contiene->idEmpresa = $userActual->idEmpresa;
          $contiene->save();
          if($userActual->estadoTut == 8){
            $userActual->estadoTut += 1;
            $userActual->save();
          }
        }
        else{
          $contieneAux->cantidad = $cantidades[$i];
          $contieneAux->save();
        }
      }
    }
  }
}
