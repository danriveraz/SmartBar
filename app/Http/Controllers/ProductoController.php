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
     public function index(Request $request){
      $categorias = Categoria::where('idAdmin' , Auth::id())->
                               lists('nombre','id');
      $productos = Producto::Search($request->nombre)->
                             Category($request->categorias)->
                             where('idAdmin' , Auth::id())->
                             orderBy('id','ASC')->
                             paginate(20);
      return view('producto.index',compact('categorias'))->with('productos',$productos);
  }

  public function create(Request $request){

      $categorias = Categoria::where('idAdmin' , Auth::id())->
                               lists('nombre','id');

      return view('producto.create',compact('categorias'));
    }

  public function store(Request $request){
    $producto = new Producto;
    $producto->nombre = $request->nombreProducto;
    $producto->precio = $request->precio;
    $producto->idCategoria = $_POST['categorias'];
    $producto->idAdmin = Auth::id();
    $producto->save();
    Flash::success("El producto se ha registrado satisfactoriamente")->important();
    session_start();
    $_SESSION['idProducto'] = $producto->id;
    return redirect()->route('contiene.index');
  }

  public function show($id){

  }

  public function edit($id){
    $categorias = Categoria::lists('nombre','id');
    $producto = Producto::find($id);
    return view('producto.edit',compact('categorias'))->with('producto',$producto);
  }

  public function update(Request $request,$id){
    $producto = Producto::find($id);
    $producto->nombre = $request->nombreProducto;
    $producto->precio = $request->precio;
    $producto->idCategoria = $_POST['categorias'];
    $producto->idAdmin = Auth::id();
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
