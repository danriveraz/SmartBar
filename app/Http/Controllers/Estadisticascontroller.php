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
        //Bloque de notificaciones
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
        //Fin del bloque de notificaciones

        //Se agragan las fechas al request para que en las funciones que lo reciba se pueda acceder a los datos
        $request->request->add(['fechaInicio' => '0000-01-01']);
        $request->request->add(['fechaFin' => '9999-01-01']);
        // ya que la primer estadística es en todo el tiempo de existencia, se agrega esta fecha para asegurar que retorne todos los datos


        $categorias = $this->categoriasMasVendidas($request);// obtiene el id de las 4 categorias más vendida
        $categoriasToJson = $this->ventasCategoriasPorSemana($request);//Llamado a la función para el comportamiento de ventas por semana de las categorias


        return view('Estadisticas.inicio')          
            ->with('notificaciones',$notificaciones)
            ->with('nuevas',$nuevas)
            ->with('fecha2array',$fecha2array)
            ->with('categorias',$categorias)
            ->with('categoriasVentasPorSemana',$categoriasToJson);
    }

    public function categoriasMasVendidas(Request $request){
        return Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();
    }

    public function ventasCategoriasPorSemana(Request $request){
        $categorias = $this->categoriasMasVendidas($request);// obtiene el id de las 4 categorias más vendidas

        $CategoriasPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
            ->whereIn('categoria.id', $categorias->pluck('idCategoria')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idCategoria','categoria.nombre',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idCategoria')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json

        foreach ($CategoriasPorSemana as $key => $categoria) {
            if($numSemana!=$categoria->semana){// Cada que el número de la semana cambie accede aqui, se agrega la semana anterior al arreglo general y se reinicia el arreglo auxiliar para la próxima semana
                if(!(empty($auxSemana) )){// validación por si es vacio el arreglo
                    array_push($categoriasToJson, $auxSemana);
                }
                $auxSemana = array();
                $numSemana = $categoria->semana;
                $auxSemana['semana']=$categoria->anio." W".$numSemana;
                foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                    $auxSemana[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
                }
            }
            $auxSemana[$categoria->nombre]=$categoria->total;// se guarda el total de la categoria 
            $numSemana=$categoria->semana;
        }
        array_push($categoriasToJson, $auxSemana);// se agrega al arreglo general, el último auxiliar, ya que en foreach no se agrega el último

        $categoriasToJson = json_encode($categoriasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $categoriasToJson;

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