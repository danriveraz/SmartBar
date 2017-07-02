<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Producto;
use PocketByR\Categoria;


class ProductoController extends Controller
{
     public function index(Request $request){
      $categorias = Categoria::orderBy('idCategoria', 'ASC');

      $productos = Producto::orderBy('idProducto','ASC')->
                       paginate(20);
      return view('producto.index')->
      with('productos',$productos);
  }

  public function create(){
    print("hola");
  }

  public function edit($id){
    $producto = Insumo::find($id);
    print(producto);
  }

}
