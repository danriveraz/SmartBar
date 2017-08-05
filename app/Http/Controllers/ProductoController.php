<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Producto;
use PocketByR\Categoria;
use Laracasts\Flash\Flash; 
use Auth;

class ProductoController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
    $userActual = Auth::user();
    if (!$userActual->esAdmin) {
      flash('No Tiene Los Permisos Necesarios')->error()->important();
      return redirect('/WelcomeTrabajador')->send();
    }  
  }  

  public function index(Request $request){
    $userActual = Auth::user();
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id');
    $cats = Categoria::all()->where('idEmpresa',$userActual->idEmpresa);                         
    return view('producto.index',compact('categorias'))->with('cats', $cats);
  }

  function modificar(Request $request){
    $producto = Producto::find($request->id);
    $producto->nombre = $request->nombre;
    $producto->precio = $request->precio;
    $producto->idCategoria = $request->categoria;
    $producto->receta = $request->receta;
    $producto->save();    
  }  

  public function listall(Request $request){
    $userActual = Auth::user();
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id');
    $productos = Producto::Search($request->nombre)->
                           Category($request->categorias)->
                           where('idEmpresa' , $userActual->idEmpresa)->
                           orderBy('id','ASC')->
                           paginate(15);
    return view('producto.listall',compact('categorias'))->with('productos',$productos);
  }

  public function create(Request $request){
    $userActual = Auth::user();
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id','precio');
    $cats = Categoria::all()->where('idEmpresa',$userActual->idEmpresa);
    return view('producto.create',compact('categorias'))->with('cats', $cats);
  }

  public function store(Request $request){
    $userActual = Auth::user();
    $producto = new Producto;
    $producto->nombre = $request->nombreProducto;
    $producto->precio = $request->precio;
    $producto->idCategoria = $_POST['categorias'];
    $producto->receta = $request->receta;
    $producto->idEmpresa = $userActual->idEmpresa;
    $producto->save();
    Flash::success("El producto se ha registrado satisfactoriamente")->important();
    session_start();
    $_SESSION['idProducto'] = $producto->id;
    return redirect()->route('contiene.index');
  }

  public function show($id){

  }

  public function edit($id){
    $userActual = Auth::user();
    $producto = Producto::find($id);
    $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                             lists('nombre','id');
    $cats = Categoria::all()->where('idEmpresa',$userActual->idEmpresa);
    
    return view('producto.edit',compact('categorias'))->with('producto',$producto)
    ->with('cats',$cats);
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
    $_SESSION['idProducto'] = $id;
    return redirect()->route('contiene.index');
  }

   public function destroy($id){
      
  }



}
