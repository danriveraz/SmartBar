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
                             orderBy('idProducto','ASC')->
                             paginate(20);
      return view('producto.index',compact('categorias'))->with('productos',$productos);
  }

  public function create(Request $request){

      $categorias = Categoria::lists('nombre','idCategoria');

      return view('producto.create',compact('categorias'));
    }
    public function store(Request $request){
      $producto = new Producto;
      $producto->nombre = $request->nombreProducto;
      $producto->idCategoria = $_POST['categorias'];
      $producto->idAdmin = 1;
      $producto->save();
      Flash::success("El producto se ha registrado satisfactoriamente")->important();
      return redirect()->route('auth.contiene.create');
    }

  public function edit($id){
    $producto = Producto::find($id);
    print($producto);
  }

}
