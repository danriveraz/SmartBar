<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Categoria;
use PocketByR\Producto;
use PocketByR\Contiene;
use Laracasts\Flash\Flash;
use Auth;

class CategoriaController extends Controller
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
      return view('Categoria.index');
  	}

    public function listall(Request $request){
      $userActual = Auth::user();
      $nombre = $request->nombre;
      $idEmpresa = $userActual->idEmpresa;
      $arreglo = array($nombre,$idEmpresa);
      $categorias = Categoria::Search($arreglo)->
                                get();
      $productos = Producto::where('idCategoria' , $userActual->idEmpresa)->get();

      $arregloProductos[] = array();

      for ($i=0; $i < sizeof($categorias); $i++) { 
          array_push($arregloProductos, Producto::where('idCategoria' , $categorias[$i]->id)->get());
          //
      }
      array_shift($arregloProductos);
      //dd(sizeof($arregloProductos[0]));
      return view('Categoria.listall')->with('categorias',$categorias)->with('arregloProductos',$arregloProductos);
    }

  	public function store(Request $request){
      $userActual = Auth::user();
      $categoria = new Categoria;
      $categoria->nombre = $request->nombre;
      $categoria->precio = $request->precio;
      $categoria->idEmpresa = $userActual->idEmpresa;
      $categorias = Categoria::where('idEmpresa' , $userActual->idEmpresa)->
                               lists('nombre','id');
      if(sizeof($categorias) == 0){
        $userActual->estadoTut += 1;
        $userActual->save();
      }
      $categoria->save();
      $tab = 'categorias';
      Flash::success("La categoria se ha registrado satisfactoriamente")->important();
      return redirect()->route('Auth.usuario.editUsuario',$tab);
  	}

   	public function edit($id){
   		$categoria = Categoria::find($id);
   		return view('Categoria.edit')->with('categoria', $categoria);

  	}

    public function show($id){
      $categoria = Categoria::find($id);
      $categoria->delete();
      Flash::success('La categoría ha sido eliminada de forma exitosa')->important();
      return redirect()->route('categoria.index');
    }

    public function update(Request $request, $id){
      $userActual = Auth::user();
   		$categoria = Categoria::find($id);
      $categoria->nombre = $request->nombre;
      $categoria->precio = $request->precio;
      $categoria->idEmpresa = $userActual->idEmpresa;
      $categoria->save();
      flash::warning('La categoria ha sido modificada satisfactoriamente')
      ->important();
      return redirect()->route('categoria.index');
    }

   public function eliminar(Request $request){
      $categoria = Categoria::find($request->id);
      $productos = Producto::category($categoria->id)->get();
      for ($i=0; $i < sizeof($productos); $i++) { 
        $contenido = Contiene::idProducto($productos[$i]->id)->get();
        for ($j=0; $j < sizeof($contenido); $j++) { 
          $contenido[$j]->delete();
        }
        $productos[$i]->eliminado = 1;
        $productos[$i]->save();
      }
      $categoria->eliminado = 1;
      $categoria->save();
    }   

    public function modificar(Request $request){
      $categoria = Categoria::find($request->id);
      $categoria->nombre = $request->nombre;
      $categoria->precio = $request->precio;
      $categoria->save();
    } 
}
