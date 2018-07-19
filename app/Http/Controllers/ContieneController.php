<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Insumo;
use PocketByR\Producto;
use PocketByR\Contiene;
use PocketByR\Categoria;
use Laracasts\Flash\Flash;
use PocketByR\Notificaciones;
use Carbon\Carbon;
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

    $notificaciones = Notificaciones::Usuario(Auth::id())->get();
    $nuevas = 0;
    $fechaActual = Carbon::now()->subHour(5);
    $fecha2array = array();
    for ($i=0; $i < sizeof($notificaciones); $i++) { 
      if($notificaciones[$i]->estado == "nueva"){
        $nuevas = $nuevas + 1;
      }
      $fechaNotificacion = Carbon::parse($notificaciones[$i]->fecha);
      $diferencia = $fechaActual->diffInDays($fechaNotificacion,true);
      array_push($fecha2array, array($notificaciones[$i]->id, $diferencia));
    }

    $userActual = Auth::user();
    session_start();
    $id = $_SESSION['id'];
    $categorias = Categoria::where('idEmpresa', $userActual->empresaActual)->
                             lists('nombre','id');
    $insumosDisponibles = Insumo::Search($request->nombre)->
                          where('idEmpresa' , $userActual->empresaActual)->
                          orderBy('nombre','ASC')->
                          paginate(1000);
    if($id != 0){
      $insumos = Insumo::lists('nombre','id');
      $medidas = Insumo::lists('medida', 'id');
      $contienen = Contiene::IdProducto($id)->
                             orderBy('idInsumo','ASC')->
                             paginate(50);
      $producto = Producto::find($id);
      return view('Contiene.index')->with('insumos',$insumos)->
                                   with('contienen',$contienen)->
                                   with('producto',$producto)->
                                   with('insumosDisponibles',$insumosDisponibles)->
                                   with('categorias', $categorias)->
                                   with('medidas', $medidas)->
                                   with('nuevas', $nuevas)->
                                   with('notificaciones',$notificaciones)->
                                   with('fecha2array',$fecha2array);
    }else{
      $producto = new Producto;
      $producto->id = 0;
      $producto->imagen = "admins/bar.png";
      $contienen = [];
      $insumos = [];
      $medidas = [];

      return view('Contiene.index')->with('insumos',$insumos)->
                                   with('contienen',$contienen)->
                                   with('producto',$producto)->
                                   with('insumosDisponibles',$insumosDisponibles)->
                                   with('categorias', $categorias)->
                                   with('medidas', $medidas)->
                                   with('nuevas', $nuevas)->
                                   with('notificaciones',$notificaciones);
    }
  }

  public function listall(Request $request){
    $userActual = Auth::user();
    session_start();
    $idProducto = $_SESSION['idProducto'];

    $insumos = Insumo::lists('nombre','id');

    $insumosDisponibles = Insumo::Search($request->nombre)->
                          where('idEmpresa' , $userActual->empresaActual)->
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
                             where('idEmpresa',$userActual->empresaActual)->first();
    if($contieneAux != null){
      $contieneAux->delete();
    }
  }

  public function guardar(Request $request){
    $userActual = Auth::user();
    $idProducto = null;
    if($request->idProducto != 0){
      $idProducto = $request->idProducto;
      $producto = Producto::find($idProducto);
      $producto->nombre = $request->nombre;
      $producto->precio = $request->precio;
      $producto->idCategoria = $request->categoria;
      $producto->descripcion = $request->descripcion;
      $producto->receta = $request->receta;
      $producto->vaso = $request->copa;
      $producto->save();
    }else{
      $producto = new Producto;
      $producto->nombre = $request->nombre;
      $producto->precio = $request->precio;
      $producto->idCategoria = $request->categoria;
      $producto->receta = $request->receta;
      $producto->idEmpresa = $userActual->empresaActual;
      $producto->save();
      $producto = Producto::Nombre($request->nombre)->Category($request->categoria)->first();
      $idProducto = $producto->id;
    }

    $idInsumos = $request->insumos;
    $cantidades = $request->cantidades;

    $cantidadInsumos = sizeOf($idInsumos);

    if($cantidadInsumos != 0){
      for($i=0; $i<$cantidadInsumos; $i++){
        $contieneAux = Contiene::IdProducto($idProducto)->
                                 IdInsumo($idInsumos[$i])->
                                 where('idEmpresa',$userActual->empresaActual)->first();
        if($contieneAux == null){
          $contiene = new Contiene;
          $contiene->idProducto = $idProducto;
          $contiene->idInsumo = $idInsumos[$i];
          $contiene->cantidad = $cantidades[$i];
          $contiene->idEmpresa = $userActual->empresaActual;
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
