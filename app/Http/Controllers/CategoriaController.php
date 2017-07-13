<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Categoria;
use Laracasts\Flash\Flash;


class CategoriaController extends Controller
{
    public function index(Request $request){
      $categorias = Categoria::orderBy('id','ASC')->
                       paginate(10);
      return view('categoria.index')->with('categorias',$categorias);
  	}

	public function create(){
    	return view('categoria.create');
  	}

  	public function store(Request $request){
      $categoria = new Categoria;
      $categoria->nombre = $request->nombre;
      $categoria->idAdmin = 4;
      $categoria->save();
      Flash::success("La categoria se ha registrado satisfactoriamente")->important();
      return redirect()->route('producto.index');
  	}

   	public function edit($id){
   		$categoria = Categoria::find($id);
   		return view('categoria.edit')->with('categoria', $categoria);

  	}

    public function update(Request $request, $id){
   		$categoria = Categoria::find($id);

      	$categoria->nombre = $request->nombre;
      	$categoria->idAdmin = 4;
      	$categoria->save();
      	flash::warning('La categoria ha sido modificada satisfactoriamente')->important();
      	return redirect()->route('producto.index');
    }

    public function destroy($id){
    	$categoria = Categoria::find($id);
    	$categoria->delete();
    	Flash::success('La categoría ha sido eliminada de forma exitosa')->important();
    	return redirect()->route('categoria.index');
  }
}
