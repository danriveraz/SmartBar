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
use Illuminate\Support\Facades\Log;

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
        $categoriasSemana = $this->ventasCategoriasPorSemana($request);//Llamado a la función para el comportamiento de ventas por semana de las categorias
        $categoriasDia = $this->ventasCategoriasPorDia($request);//Llamado a la función para el comportamiento de ventas por Dia de las categorias
        $categoriasMes = $this->ventasCategoriasPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de las categorias

        $request->request->add(['fechaInicio' => Carbon::now()]);
        $categoriasHora = $this->ventasCategoriasPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de las categorias


        return view('Estadisticas.inicio')          
            ->with('notificaciones',$notificaciones)
            ->with('nuevas',$nuevas)
            ->with('fecha2array',$fecha2array)
            ->with('categorias',$categorias)
            ->with('categoriasVentasPorSemana',$categoriasSemana)
            ->with('categoriasVentasPorDia',$categoriasDia)
            ->with('categoriasVentasPorMes',$categoriasMes)
            ->with('categoriasVentasPorHora',$categoriasHora);
    }

    public function categoriasMasVendidas(Request $request){
        $categorias =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $cols = [['id'=> 'Nombre','label'=> 'Nombre', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];
        $rows = array();
        foreach ($categorias as $key => $categoria) {
            array_push($rows, ['c'=> [ ['v' => $categoria->nombre ] , ['v'=>$categoria->total ] ]]);
        }
        $jsonGrafcas = ['cols' => $cols , 'rows' => $rows];            
        //dd(json_encode($rows ,JSON_NUMERIC_CHECK));

        return json_encode($jsonGrafcas);
    }



    public function ventasCategoriasPorSemana(Request $request){
        //Log::info('fecha Inicio'.$request->fechaInicio);
        //Log::info('fecha Fin'.$request->fechaFin);
        $categorias = Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de las 4 categorias más vendidas

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
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> 'Cantidad de Ventas de '.$nombre, 'type'=> 'number']);
        }

        foreach ($CategoriasPorSemana as $key => $categoria) {
            if($numSemana!=$categoria->semana){// Cada que el número de la semana cambie accede aqui, se agrega la semana anterior al arreglo general y se reinicia el arreglo auxiliar para la próxima semana
                if(!(empty($auxSemana) )){// validación por si es vacio el arreglo
                    array_push($categoriasToJson, $auxSemana);
                }
                $auxSemana = array();
                $numSemana = $categoria->semana;
                //$auxSemana['semana']=$categoria->anio." W".$numSemana;
                $auxSemana['semana']=$numSemana;
                foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                    $auxSemana[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
                }
            }
            $auxSemana[$categoria->nombre]=$categoria->total;// se guarda el total de la categoria 
            $numSemana=$categoria->semana;
        }
        array_push($categoriasToJson, $auxSemana);// se agrega al arreglo general, el último auxiliar, ya que en foreach no se agrega el último


        $rows = array();   
        foreach ($categoriasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $categoriasToJson = ['cols' => $cols , 'rows' => $rows];


        $categoriasToJson = json_encode($categoriasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $categoriasToJson;

    }





    public function ventasCategoriasPorDia(Request $request){
        $categorias = Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de las 4 categorias más vendidas

        $CategoriasPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
            ->whereIn('categoria.id', $categorias->pluck('idCategoria')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('DAY(`fecha`) as dia'),'idCategoria','categoria.nombre',DB::raw('MONTH(`fecha`) as mes'))
            ->groupBy('idCategoria')
            ->groupBy(DB::raw('MONTH(`fecha`)'))
            ->groupBy(DB::raw('DAY(`fecha`)'))//se hace el group by por el día en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> 'Cantidad de Ventas de '.$nombre, 'type'=> 'number']);
        }

        foreach ($CategoriasPorDia as $key => $categoria) {
            if($numDia!=$categoria->dia){// Cada que el número de la semana cambie accede aqui, se agrega la semana anterior al arreglo general y se reinicia el arreglo auxiliar para la próxima semana
                if(!(empty($auxDia) )){// validación por si es vacio el arreglo
                    array_push($categoriasToJson, $auxDia);
                }
                $auxDia = array();
                $numDia = $categoria->dia;
                $auxDia['dia']=$categoria->mes."/".$numDia;
                //$auxDia['dia']=$numDia;
                foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                    $auxDia[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
                }
            }
            $auxDia[$categoria->nombre]=$categoria->total;// se guarda el total de la categoria 
            $numDia=$categoria->dia;
        }
        array_push($categoriasToJson, $auxDia);// se agrega al arreglo general, el último auxiliar, ya que en foreach no se agrega el último


        $rows = array();   
        foreach ($categoriasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $categoriasToJson = ['cols' => $cols , 'rows' => $rows];


        $categoriasToJson = json_encode($categoriasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $categoriasToJson;

    }




    public function ventasCategoriasPorMes(Request $request){
        $categorias = Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de las 4 categorias más vendidas

        $CategoriasPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
            ->whereIn('categoria.id', $categorias->pluck('idCategoria')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),'idCategoria','categoria.nombre',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idCategoria')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json
        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> 'Cantidad de Ventas de '.$nombre, 'type'=> 'number']);
        }

        foreach ($CategoriasPorMes as $key => $categoria) {
            if($numMes!=$categoria->mes){// Cada que el número del mes cambie accede aqui, se agrega la semana anterior al arreglo general y se reinicia el arreglo auxiliar para el próximo mes
                if(!(empty($auxMes) )){// validación por si es vacio el arreglo
                    array_push($categoriasToJson, $auxMes);
                }
                $auxMes = array();
                $numMes = $categoria->mes;
                $auxMes['mes']=$categoria->anio."/".$numMes;
                //$auxMes['mes']=$numMes;
                foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                    $auxMes[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
                }
            }
            $auxMes[$categoria->nombre]=$categoria->total;// se guarda el total de la categoria 
            $numMes=$categoria->mes;
        }
        array_push($categoriasToJson, $auxMes);// se agrega al arreglo general, el último auxiliar, ya que en foreach no se agrega el último


        $rows = array();   
        foreach ($categoriasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        //dd($categoriasToJson);
        $categoriasToJson = ['cols' => $cols , 'rows' => $rows];

        $categoriasToJson = json_encode($categoriasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $categoriasToJson;

    }



    public function ventasCategoriasPorHora(Request $request){
        //Se calculan las horas de búsqueda al rededor de un día
        $fechaInicio = new Carbon($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);

        $categorias = Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de las 4 categorias más vendidas

        $CategoriasPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
            ->whereIn('categoria.id', $categorias->pluck('idCategoria')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),'idCategoria','categoria.nombre',DB::raw('DAY(`fecha`) as dia'))
            ->groupBy('idCategoria')
            ->groupBy(DB::raw('DAY(`fecha`)'))
            ->groupBy(DB::raw('HOUR(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();


        $auxHora = array();//array auxiliar donde se guarda la información por Hora
        $numHora = 0; // variable para guardar la hora
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas las horas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string']];
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

// este while crea un arreglo con posiciones reservadas por cada hora que se va a graficar en la vista, recorre hora por hora 
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
            }
            $categoriasToJson[$fechaInicio->day."/".$fechaInicio->hour] = $auxLLenar;
            $fechaInicio->addHours(1);
        }

//Todo lo que está comentado es  como está hecho en las funciones anteriores, solo que ahora tiene en cuenta las horas en las que no se vendió nada, para una mejor visualización de los datos, si queda bien, ya se podrá borrar
        foreach ($CategoriasPorHora as $key => $categoria) {
            /*if($numHora!=$categoria->hora){// Cada que el número de la hora cambie accede aqui, se agrega la semana anterior al arreglo general y se reinicia el arreglo auxiliar para la proxima hora
                if(!(empty($auxHora) )){// validación por si es vacio el arreglo
                    array_push($categoriasToJson, $auxHora);
                }
                $auxHora = array();
                $numHora = $categoria->hora;
                $auxHora['hora']=$categoria->dia."/".$numHora.":00";
                //$auxHora['hora']=$numHora;
                foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                    $auxHora[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
                }
            }
            */
            $categoriasToJson[$categoria->dia."/".$categoria->hora][$categoria->nombre]=$categoria->total;// se guarda el total de la categoria 
            //$numHora=$categoria->hora;
        }
        //array_push($categoriasToJson, $auxHora);// se agrega al arreglo general, el último auxiliar, ya que en foreach no se agrega el último


        $rows = array();   
        foreach ($categoriasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows, JSON_PRETTY_PRINT));
        $categoriasToJson = ['cols' => $cols , 'rows' => $rows];

        $categoriasToJson = json_encode($categoriasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $categoriasToJson;

    }

} 




