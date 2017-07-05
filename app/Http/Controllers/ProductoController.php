<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PocketByR\Producto;
use PocketByR\Categoria;
use Laracasts\Flash\Flash;


class ProductoController extends Controller
{
     public function index(Request $request){
      $categorias = Categoria::lists('nombre','id');

      $productos = Producto::Search($request->nombre)->
                             Category($request->categorias)->
                             orderBy('id','ASC')->
                             paginate(20);
      return view('producto.index',compact('categorias'))->with('productos',$productos);
  }

  public function create(Request $request){

      $categorias = Categoria::lists('nombre','id');

      return view('producto.create',compact('categorias'));
    }
    public function store(Request $request){
      $producto = new Producto;
      $producto->nombre = $request->nombreProducto;
      $producto->precio = $request->precio;
      $producto->idCategoria = $_POST['categorias'];
      $producto->idAdmin = 4;
      $producto->save();
      Flash::success("El producto se ha registrado satisfactoriamente")->important();
      return redirect()->route('auth.contiene.index', ['idProducto'=>$producto->id]);
    }

  public function edit($id){
    $producto = Producto::find($id);
    print($producto);
  }

}
