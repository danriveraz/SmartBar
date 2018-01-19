<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Producto;
use PocketByR\Insumo;
use PocketByR\Contiene;
use PocketByR\Categoria;
use Laracasts\Flash\Flash; 
use Auth;

class ProductoController extends Controller
{

  public function __construct(){
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
    $userActual = Auth::user();
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id');
    $productos = Producto::Search($request->nombre)->
                           Category($request->categorias)->
                           where('idEmpresa' , $userActual->idEmpresa)->
                           orderBy('nombre','ASC')->
                           paginate(1000);
    $contenido = Contiene::where('idEmpresa', $userActual->idEmpresa);
    return view('Producto.index',compact('categorias'))->with('productos',$productos)->with('contenido', $contenido);
  }

  function ingredientes(Request $request){
    $userActual = Auth::user();
    $contenido = Contiene::where('idEmpresa',$userActual->idEmpresa)->IdProducto($request->id)->get();
    $datos = array();
    $count = 0;
    foreach ($contenido as $contiene) {
      $insumo = Insumo::find($contiene->idInsumo);
      $datos = array_add($datos, $count,[$contiene->cantidad, $insumo->nombre]);
      $count++;
    }
    return json_encode($datos);
  }

  function ingrediente($idInsumo){
    $insumo = Insumo::where('id', $idInsumo);
    return $insumo->nombre;
  }

  function modificar(Request $request){
    $producto = Producto::find($request->id);
    $producto->nombre = $request->nombre;
    $producto->precio = $request->precio;
    $producto->idCategoria = $request->categoria;
    $producto->save();
  }
  
  public function eliminar(Request $request){
    $contenido = Contiene::idProducto($request->id)->get();
    foreach($contenido as $contiene){
      $contiene->delete();
    }
    $producto = Producto::find($request->id);
    $producto->delete();
  }

  public function listall(Request $request){
    $userActual = Auth::user();
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id');
    $cats = Categoria::where('idEmpresa',$userActual->idEmpresa)->get();
    $productos = Producto::Search($request->nombre)->
                           Category($request->categorias)->
                           where('idEmpresa' , $userActual->idEmpresa)->
                           orderBy('nombre','ASC')->
                           paginate(1000);
    return view('Producto.listall',compact('categorias'))->with('productos',$productos)->with('cats',$cats);
  }

  public function create(Request $request){
    $userActual = Auth::user();
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id','precio');
    $cats = Categoria::where('idEmpresa',$userActual->idEmpresa)->get();
    return view('Producto.create',compact('categorias'))->with('cats', $cats);
  }

  public function store(Request $request){
    $userActual = Auth::user();
    $existe = Producto::Empresa($userActual->idEmpresa)->Nombre($request->nombre)->first();
    if(is_null($existe)){
      $producto = new Producto;
      $producto->nombre = $request->nombre;
      $producto->idCategoria = $_POST['categorias'];
      $producto->idEmpresa = $userActual->idEmpresa;
      $productos = Producto::where('idEmpresa' , $userActual->idEmpresa)->
                                lists('nombre','id');
      if(sizeof($productos) == 0){
        $userActual->estadoTut += 1;
        $userActual->save();
      }
      if($request->precio!=""){
        $producto->precio = $request->precio;
      }else{
        $cat = Categoria::where('id',$_POST['categorias'])->first();
        $producto->precio = $cat->precio;
      }
      $producto->save();
      Flash::success("El producto se ha registrado satisfactoriamente")->important();
      session_start();
      $_SESSION['idProducto'] = $producto->id;
      $_SESSION['nombre'] = $producto->nombre;
      return redirect()->route('contiene.index');
    }else{
      Flash::error("Ya existe un producto con ese nombre")->important();
      $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');
      $cats = Categoria::where('idEmpresa',$userActual->idEmpresa)->get();
      $productos = Producto::where('idEmpresa' , $userActual->idEmpresa)->
                           orderBy('nombre','ASC')->
                           paginate(1000);
      return view('Producto.index',compact('categorias'))->with('productos',$productos)->with('cats', $cats);
    }
  }

  public function show($id){

  }

  public function edit($id){
    $userActual = Auth::user();
    $producto = Producto::find($id);
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id');
    //return redirect()->route('contiene.index');
    return view('Contiene.index',compact('categorias'))->with('producto',$producto);
  }

  public function update(Request $request,$id){
    $userActual = Auth::user();
    $producto = Producto::find($id);
    $producto->nombre = $request->nombreProducto;
    $producto->precio = $request->nPrecio;
    $producto->idCategoria = $_POST['categorias'];
    $producto->receta = $request->receta;
    $producto->save();
    Flash::success("El producto se ha modificado satisfactoriamente")->important();
    return redirect()->route('producto.index');
  }

  public function insumoedit($id){
    session_start();
    $producto = Producto::find($id);
    $_SESSION['idProducto'] = $id;
    $_SESSION['nombre'] = $producto->nombre;
    return redirect()->route('contiene.index');
  }

   public function destroy($id){
      
  }



}
