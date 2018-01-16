<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Producto;
use PocketByR\Contiene;
use PocketByR\Categoria;
use PocketByR\Factura;

class welcomeAdmin extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Permisos:Admin');
        /*$userActual = Auth::user();
        if($userActual != null){
            if (!$userActual->esAdmin) {
                flash('No Tiene Los Permisos Necesarios')->error()->important();
                return redirect('/WelcomeTrabajador')->send();
            }
        }*/

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categorias = Factura::todasLasVentas(Auth::user()->empresaActual)->get();
        //dd($categoriasMasVendidas)->get();
        $categoriasMasVendidas = array();
        foreach ($categorias as $key => $categoria) {
            array_push($categoriasMasVendidas,Categoria::find($categoria->idCategoria));
        }
        //dd($categoriasMasVendidas);
        return View('WelcomeAdmin/welcome')->with('categoriasMasVendidas',$categoriasMasVendidas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
