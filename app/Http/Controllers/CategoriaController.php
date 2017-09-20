<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Categoria;
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
      return view('Categoria.listall')->with('categorias',$categorias);
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
      Flash::success("La categoria se ha registrado satisfactoriamente")->important();
      return redirect()->route('categoria.index');
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
      $categoria->delete();
    }   
    public function modificar(Request $request){
      $categoria = Categoria::find($request->id);
      $categoria->nombre = $request->nombre;
      $categoria->precio = $request->precio;
      $categoria->save();
    } 
}
