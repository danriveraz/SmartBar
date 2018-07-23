<?php
namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Mesa;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Notificaciones;
use DB;
use Carbon\Carbon;
use PocketByR\Factura; 

class EstadisticasController extends Controller

{
    //
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
        $notificaciones = Notificaciones::Usuario(Auth::User()->id)->get();
        $nuevas = 0;
        $fechaActual = Carbon::now()->subHour(5);
        $fecha2array = array();
        for ($i=0; $i < sizeof($notificaciones); $i++) { 
          if($notificaciones[$i]->estado == "nueva"){
            $nuevas = $nuevas + 1;
          }
          $fechaNotificacion = Carbon::parse($notificaciones[$i]->fecha);
          $diferencia = $fechaActual->diffInDays($fechaNotificacion,true);
          array_push($fecha2array, array($notificaciones[$i]->id, $diferencia));
        }

        $categorias = Factura::todasLasVentas(Auth::user()->empresaActual)->get();// obtiene el id de las 4 categorias más vendidas
        //dd($categorias->pluck('idCategoria')->toArray());
        $CategoriasPorSemana = Factura::where([['factura.estado', 'Finalizada']])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
            ->whereIn('categoria.id', $categorias->pluck('idCategoria')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idCategoria','categoria.nombre',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idCategoria')
            ->groupBy(DB::raw('WEEK(`fecha`)'))
            ->orderBy('fecha', 'ASC')
            ->get();

        $auxSemana = array();
        $numSemana = 0;
        $categoriasToJson = array();
        foreach ($CategoriasPorSemana as $key => $categoria) {
            if($numSemana!=$categoria->semana){
                if(!(empty($auxSemana) )){
                    array_push($categoriasToJson, $auxSemana);
                }
                $auxSemana = array();
                $numSemana = $categoria->semana;
                $auxSemana['semana']=$categoria->anio." W".$numSemana;
                foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                    $auxSemana[$nombre] = 0;
                }
            }
            $auxSemana[$categoria->nombre]=$categoria->total;
            $numSemana=$categoria->semana;
        }
        array_push($categoriasToJson, $auxSemana);
        $categoriasToJson = json_encode($categoriasToJson,JSON_NUMERIC_CHECK);
        //dd($categoriasToJson);

    	return view('Estadisticas.inicio')          
            ->with('notificaciones',$notificaciones)
            ->with('nuevas',$nuevas)
            ->with('fecha2array',$fecha2array)
            ->with('categorias',$categorias)
            ->with('categoriasVentasPorSemana',$categoriasToJson);
    } 
    } 




/* 
<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;

use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;

class Estadisticascontroller extends Controller
{
    //
} 

*/