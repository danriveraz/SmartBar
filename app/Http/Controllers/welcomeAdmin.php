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
use DB;
use Carbon\Carbon;

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
        $categoriasMasVendidas = $this->categoriasMasVendidas();// llamado a la función queretorna un arreglo con dos valores

        $ventaTotal = Factura::totalEnTodasLasVentas(Auth::user()->empresaActual)->first();
        $meserosMasVendedores =  Factura::ventasMesero(Auth::user()->empresaActual,$ventaTotal->totalVentas)->get();
        $bartenderMasVendedores =  Factura::ventasBartender(Auth::user()->empresaActual,$ventaTotal->totalVentas)->get();
        $cajeroMasVendedores =  Factura::ventasCajero(Auth::user()->empresaActual,$ventaTotal->totalVentas)->get();

        return View('WelcomeAdmin/welcome')->with('categoriasMasVendidas',$categoriasMasVendidas['categoriasMasVendidas'])
                    ->with('sumaVentasDeCadaCategoria',$categoriasMasVendidas['sumaVentasDeCadaCategoria'])
                    ->with('meserosMasVendedores',$meserosMasVendedores)
                    ->with('bartenderMasVendedores',$bartenderMasVendedores)
                    ->with('cajeroMasVendedores',$cajeroMasVendedores);
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

    public function categoriasMasVendidas(){//Función auxiliar para la consulta de las categorias más vendidas 

        $categorias = Factura::todasLasVentas(Auth::user()->empresaActual)->get();// obtiene el id de las 4 categorias más vendidas
        $categoriasMasVendidas = array();// arreglo donde se guarda el objeto categoria de las 4 más vendidas
        foreach ($categorias as $key => $categoria) {
            array_push($categoriasMasVendidas,Categoria::find($categoria->idCategoria));
        }

        $carbon = new \Carbon\Carbon();

        $sumaVentasDeCadaCategoria = array(); // arreglo donde se guardar la suma de las ventas de cada categoria 
        foreach ($categorias as $key => $categoria) {

            $fechaInicioEstadisticas = $carbon->now()->subWeek(5)->startOfWeek();// fecha del lunes, de la sexta semana anterior

            $sumas = array();// arreglo para las ventas de cada semana
            for ($i=0; $i <6 ; $i++) { 
                $fechaInit = $fechaInicioEstadisticas->toDateTimeString();//inicio de semana
                $fechaFin = $fechaInicioEstadisticas->addWeek(1)->toDateTimeString();//Fin desemana
                $suma =  $ventasDespuesDe = Factura::ventasEntreFechas($categoria->idCategoria,$fechaInit,$fechaFin)
                        ->select(DB::raw('SUM(`cantidad`) as total'))
                        ->first();// todas las ventas de la categoria después de la fecha de inicio de la sexta semana anterior
                array_push($sumas, $suma->total);
            }
            $ventaSemanaActual= intval(end($sumas));
            $ventaSemanaPasada = intval(prev($sumas));
            if (($ventaSemanaPasada == 0) && ($ventaSemanaActual != 0 )) {
                $porcentaje = 100;
            } elseif(($ventaSemanaPasada == 0) && ($ventaSemanaActual == 0 )){
                $porcentaje = 0;
            } else {
                $porcentaje = ($ventaSemanaActual*100)/($ventaSemanaPasada)-100;
            }
            
            $classEtiqueta = "fa fa-pause text-success";
            if ($porcentaje<0) {
                   $classEtiqueta = "fa fa-caret-down text-danger";
               } elseif($porcentaje>0) {
                   $classEtiqueta = "fa fa-caret-up text-success";
               }
            array_push($sumas, $porcentaje);
            array_push($sumas, $classEtiqueta);

            array_push($sumaVentasDeCadaCategoria, $sumas); 
        }

        return array('categoriasMasVendidas' => $categoriasMasVendidas, 'sumaVentasDeCadaCategoria' => $sumaVentasDeCadaCategoria);
    }
}
