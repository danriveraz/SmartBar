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

  public function create(Request $request){
      return view('producto.create');
    }
    public function store(Request $request){
      $producto = new Producto;
      $producto->nombre = $request->nombreProducto;
      $producto->tipo = $_POST['TipoProducto'];
      $producto->idAdmin = 1;
      $producto->save();
      Flash::success("El producto se ha registrado satisfactoriamente")->important();
      return redirect()->route('auth.contiene.create');
    }

  public function edit($id){
    $producto = Insumo::find($id);
    print(producto);
  }

}
