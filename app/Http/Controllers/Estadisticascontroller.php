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
    public function __construct(){
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

        $productos = $this->productosMasVendidos($request);// obtiene el id de los 4 productos más vendidos
        $productosSemana = $this->ventasProductosPorSemana($request);//Llamado a la función para el comportamiento de ventas por semana de los producto
        $productosDia = $this->ventasProductosPorDia($request);
        $productosMes = $this->ventasProductosPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de los productos
        $categorias = $this->categoriasMasVendidas($request);// obtiene el id de las 4 categorias más vendida
        $categoriasSemana = $this->ventasCategoriasPorSemana($request);//Llamado a la función para el comportamiento de ventas por semana de las categorias
        $categoriasDia = $this->ventasCategoriasPorDia($request);//Llamado a la función para el comportamiento de ventas por Dia de las categorias
        $categoriasMes = $this->ventasCategoriasPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de las categorias
        $meseros = $this->ventaMeserosTotal($request);// obtiene el id de los 4 Meseros que  más  han vendidos
        $meserosSemana = $this->ventasMeserosPorSemana($request);// Llamado a la función para el comportamiento de ventas por semana de los meseros
        $meserosDia = $this->ventasMeserosPorDia($request);//Llamado a la función para el comportamiento de ventas por Dia de los meseros
        $meserosMes = $this->ventasMeserosPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de los meseros
        $Bartender = $this->ventaBartenderTotal($request);// obtiene el id de los 4 Bartender que  más  han vendidos
        $BartenderSemana = $this->ventasBartenderPorSemana($request);// Llamado a la función para el comportamiento de ventas por semana de los Bartender
        $BartenderDia = $this->ventasBartenderPorDia($request);//Llamado a la función para el comportamiento de ventas por Dia de los Bartender
        $BartenderMes = $this->ventasBartenderPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de los Bartender
        $Cajeros = $this->ventaCajerosTotal($request);// obtiene el id de los 4 Cajeros que  más  han vendidos
        $CajerosSemana = $this->ventasCajerosPorSemana($request);// Llamado a la función para el comportamiento de ventas por semana de los Cajeros
        $CajerosDia = $this->ventasCajerosPorDia($request);//Llamado a la función para el comportamiento de ventas por Dia de los Cajeros
        $CajerosMes = $this->ventasCajerosPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de los Cajeros
        $ventasPorSemana = $this->ventasPorSemana($request);// obtiene las ventas totales dividido en semanas
        $ventasPorDia = $this->ventasPorDia($request);// obtiene las ventas totales dividido en dias
        $ventasPorMes = $this->ventasPorMes($request);// obtiene las ventas totales dividido en Meses
        $mesas = $this->MesasQueMasVenden($request);
        $MesasMes = $this->ventasMesasPorMes($request);
        $MesasDia = $this->ventasMesasPorDia($request);
        $MesasSemana = $this->ventasMesasPorSemana($request);


        $request->request->add(['fechaInicio' => Carbon::now()]);
        $categoriasHora = $this->ventasCategoriasPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de las categorias
        $productosHora = $this->ventasProductosPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de los productos
        $meserosHora = $this->ventasMeserosPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de los meseros
        $BartenderHora = $this->ventasBartenderPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de los Bartender
        $CajerosHora = $this->ventasCajerosPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de los Cajeros
        $ventasPorHora = $this->ventasPorHora($request);//Llamado a la función para el comportamiento de ventas por Día
        $MesasHora = $this->ventasMesasPorHora($request);



        return view('Estadisticas.inicio')          
            ->with('notificaciones',$notificaciones)
            ->with('nuevas',$nuevas)
            ->with('fecha2array',$fecha2array)
            ->with('categorias',$categorias)
            ->with('categoriasVentasPorSemana',$categoriasSemana)
            ->with('categoriasVentasPorDia',$categoriasDia)
            ->with('categoriasVentasPorMes',$categoriasMes)
            ->with('categoriasVentasPorHora',$categoriasHora)
            ->with('productos',$productos)
            ->with('productosVentasPorSemana',$productosSemana)
            ->with('productosVentasPorDia',$productosDia)
            ->with('productosVentasPorMes',$productosMes)
            ->with('productosVentasPorHora',$productosHora)
            ->with('meseros',$meseros)
            ->with('meserosVentasPorSemana',$meserosSemana)
            ->with('meserosVentasPorDia',$meserosDia)
            ->with('meserosVentasPorMes',$meserosMes)
            ->with('meserosVentasPorHora',$meserosHora)
            ->with('Bartender',$Bartender)
            ->with('BartenderVentasPorSemana',$BartenderSemana)
            ->with('BartenderVentasPorDia',$BartenderDia)
            ->with('BartenderVentasPorMes',$BartenderMes)
            ->with('BartenderVentasPorHora',$BartenderHora)
            ->with('Cajeros',$Cajeros)
            ->with('CajerosVentasPorSemana',$CajerosSemana)
            ->with('CajerosVentasPorDia',$CajerosDia)
            ->with('CajerosVentasPorMes',$CajerosMes)
            ->with('CajerosVentasPorHora',$CajerosHora)
            ->with('ventasPorSemana',$ventasPorSemana)
            ->with('ventasPorHora',$ventasPorHora)
            ->with('ventasPorDia',$ventasPorDia)
            ->with('ventasPorMes',$ventasPorMes)
            ->with('mesas',$mesas)
            ->with('mesasPorHora',$MesasHora)
            ->with('mesasPorMes',$MesasMes)
            ->with('mesasPorDia',$MesasDia)
            ->with('mesasPorSemana',$MesasSemana);
    }


    public function ventasPorHora(Request $request){

        $arrayVariables = array();// array para guardar todas las variables del return

        $fechaInicio = new Carbon($request->fechaInicio);
        //dd($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);
        $diferenciaTiempo = $fechaInicio->diffInHours($fechaFin);

        $arrayVariables['fechaInicio']  = clone $fechaInicio;
        $arrayVariables['fechaFin']= $fechaFin;

        $ventasPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),DB::raw('DAY(`fecha`) as dia'),'fecha');

        $ventaTotal = clone $ventasPorHora;    
        $ventaTotal = $ventaTotal->get()->first()->total; // la suma total de las ventas en el rango de fechas

        $ventaMayor = clone $ventasPorHora;
        $ventaMayor = $ventaMayor->groupBy(DB::raw('DAY(`fecha`)'))->groupBy(DB::raw('HOUR(`fecha`)'))->orderBy('total', 'DESC')->get()->first(); // la semana con mayor ventas en el rango de fechas

        $ventaMenor = clone $ventasPorHora;
        $ventaMenor = $ventaMenor->groupBy(DB::raw('DAY(`fecha`)'))->groupBy(DB::raw('HOUR(`fecha`)'))->orderBy('total', 'ASC')->get()->first(); // la semana de menor ventas en el rango de fechas

        $ventasPorHora = $ventasPorHora->groupBy(DB::raw('DAY(`fecha`)'))->groupBy(DB::raw('HOUR(`fecha`)'))->orderBy('fecha', 'ASC')->get(); // todos los datos para la gráfica


        $ventasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];


        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            $auxLLenar['cantidad'] = 0;//se inicia el arreglo con 0
            $ventasToJson[$fechaInicio->day."/".$fechaInicio->hour.":00"] = $auxLLenar;
            $fechaInicio->addHours(1);
        }
        foreach ($ventasPorHora as $key => $hora) {
            $ventasToJson[$hora->dia."/".$hora->hora.":00"]['cantidad']=$hora->total;
        }
        //Fin de crear el arreglo

        $rows = array();   
        foreach ($ventasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $ventasToJson = ['cols' => $cols , 'rows' => $rows];


        $ventasToJson = json_encode($ventasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es enviada a la vista para las gráficas

        $arrayVariables['ventas'] = $ventasToJson;
        $arrayVariables['ventaTotal'] = $ventaTotal;
        $arrayVariables['promedio'] = $ventaTotal/$diferenciaTiempo;
        $arrayVariables['ventaMayor'] = $ventaMayor;
        $arrayVariables['ventaMenor'] = $ventaMenor;



        return json_encode($arrayVariables);

    }

    public function ventasPorSemana(Request $request){

        $arrayVariables = array();// array para guardar todas las variables del return
        $ventasPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),DB::raw('YEAR(`fecha`) as anio'),'fecha');

        $ventaTotal = clone $ventasPorSemana;    
        $ventaTotal = $ventasPorSemana->get()->first()->total; // la suma total de las ventas en el rango de fechas

        $ventaMayor = clone $ventasPorSemana;
        $ventaMayor = $ventaMayor->groupBy(DB::raw('WEEK(`fecha`)'))->orderBy('total', 'DESC')->get()->first(); // la semana con mayor ventas en el rango de fechas

        $ventaMenor = clone $ventasPorSemana;
        $ventaMenor = $ventaMenor->groupBy(DB::raw('WEEK(`fecha`)'))->orderBy('total', 'ASC')->get()->first(); // la semana de menor ventas en el rango de fechas

        $ventasPorSemana = $ventasPorSemana->groupBy(DB::raw('WEEK(`fecha`)'))->orderBy('fecha', 'ASC')->get(); // todos los datos para la gráfica
        $diferenciaTiempo=1;

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();

        if(isset($ventasPorSemana[0])){

            if($request->fechaInicio=='0000-01-01'){
                $arrayVariables['fechaInicio'] = new Carbon($ventasPorSemana[0]->fecha);
                $arrayVariables['fechaFin'] = new Carbon($ventasPorSemana->last()->fecha);

                $fechaInicio = new Carbon($ventasPorSemana[0]->fecha);
                $fechaFin = new Carbon($ventasPorSemana->last()->fecha);
                $diferenciaTiempo = $fechaInicio->diffInWeeks($fechaFin);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);
            }else{
                $arrayVariables['fechaInicio'] = new Carbon($request->fechaInicio);
                $arrayVariables['fechaFin'] = new Carbon($request->fechaFin);
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $diferenciaTiempo = $fechaInicio->diffInWeeks($fechaFin);
                $fechaInicio->subWeek(1);
            }
        }       

        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $ventasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];


        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']=$fechaInicio->year."/".$fechaInicio->weekOfYear;
            $auxLLenar['cantidad'] = 0;//se inicia el arreglo con 0
            $ventasToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($ventasPorSemana as $key => $semana) {
            $ventasToJson[$semana->anio."/".$semana->semana]['cantidad']=$semana->total;
        }
        //Fin de crear el arreglo

        $rows = array();   
        foreach ($ventasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $ventasToJson = ['cols' => $cols , 'rows' => $rows];


        $ventasToJson = json_encode($ventasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es enviada a la vista para las gráficas

        $arrayVariables['ventas'] = $ventasToJson;
        $arrayVariables['ventaTotal'] = $ventaTotal;
        $arrayVariables['promedio'] = $ventaTotal/$diferenciaTiempo;
        $arrayVariables['ventaMayor'] = $ventaMayor;
        $arrayVariables['ventaMenor'] = $ventaMenor;



        return json_encode($arrayVariables);

    }

    public function ventasPorDia(Request $request){
        $arrayVariables = array();// array para guardar todas las variables del return

        $ventasPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('DAY(`fecha`) as dia'),DB::raw('MONTH(`fecha`) as mes'),'fecha');

        $ventaTotal = clone $ventasPorDia;    
        $ventaTotal = $ventasPorDia->get()->first()->total; // la suma total de las ventas en el rango de fechas

        $ventaMayor = clone $ventasPorDia;
        $ventaMayor = $ventaMayor->groupBy(DB::raw('DAY(`fecha`)'))->orderBy('total', 'DESC')->get()->first(); // la semana con mayor ventas en el rango de fechas

        $ventaMenor = clone $ventasPorDia;
        $ventaMenor = $ventaMenor->groupBy(DB::raw('DAY(`fecha`)'))->orderBy('total', 'ASC')->get()->first(); // la semana de menor ventas en el rango de fechas

        $ventasPorDia = $ventasPorDia->groupBy(DB::raw('DAY(`fecha`)'))->orderBy('fecha', 'ASC')->get(); // todos los datos para la gráfica
        $diferenciaTiempo=1;

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($ventasPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                $arrayVariables['fechaInicio'] = new Carbon($ventasPorDia[0]->fecha);
                $arrayVariables['fechaFin'] = new Carbon($ventasPorDia->last()->fecha);
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $ventasPorDia[0]->dia;
                $fechaInicio->month = $ventasPorDia[0]->mes;
                $fechaFin->day = $ventasPorDia->last()->dia+1;
                $fechaFin->month = $ventasPorDia->last()->mes;
                $diferenciaTiempo = $fechaInicio->diffInDays($fechaFin);

                //dd($fechaInicio,$fechaFin);

            }else{
                $arrayVariables['fechaInicio'] = new Carbon($request->fechaInicio);
                $arrayVariables['fechaFin'] = new Carbon($request->fechaFin);    
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $diferenciaTiempo = $fechaInicio->diffInDays($fechaFin);
                
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $ventasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Día','label'=> 'Día', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];


        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']=$fechaInicio->month."/".$fechaInicio->day;
            $auxLLenar['cantidad'] = 0;//se inicia el arreglo con 0
            $ventasToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }
        foreach ($ventasPorDia as $key => $dia) {
            $ventasToJson[$dia->mes."/".$dia->dia]['cantidad']=$dia->total;
        }
        //Fin de crear el arreglo

        $rows = array();   
        foreach ($ventasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $ventasToJson = ['cols' => $cols , 'rows' => $rows];


        $ventasToJson = json_encode($ventasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es enviada a la vista para las gráficas

        $arrayVariables['ventas'] = $ventasToJson;
        $arrayVariables['ventaTotal'] = $ventaTotal;
        $arrayVariables['promedio'] = $ventaTotal/$diferenciaTiempo;
        $arrayVariables['ventaMayor'] = $ventaMayor;
        $arrayVariables['ventaMenor'] = $ventaMenor;



        return json_encode($arrayVariables);

    }

    public function ventasPorMes(Request $request){
        $arrayVariables = array();// array para guardar todas las variables del return

        $ventasPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),DB::raw('YEAR(`fecha`) as anio'),'fecha');

        $ventaTotal = clone $ventasPorMes;    
        $ventaTotal = $ventasPorMes->get()->first()->total; // la suma total de las ventas en el rango de fechas

        $ventaMayor = clone $ventasPorMes;
        $ventaMayor = $ventaMayor->groupBy(DB::raw('MONTH(`fecha`)'))->orderBy('total', 'DESC')->get()->first(); // la semana con mayor ventas en el rango de fechas

        $ventaMenor = clone $ventasPorMes;
        $ventaMenor = $ventaMenor->groupBy(DB::raw('MONTH(`fecha`)'))->orderBy('total', 'ASC')->get()->first(); // la semana de menor ventas en el rango de fechas

        $ventasPorMes = $ventasPorMes->groupBy(DB::raw('MONTH(`fecha`)'))->orderBy('fecha', 'ASC')->get(); // todos los datos para la gráfica
        $diferenciaTiempo=1;

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($ventasPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                $arrayVariables['fechaInicio'] = new Carbon($ventasPorMes[0]->fecha);
                $arrayVariables['fechaFin'] = new Carbon($ventasPorMes->last()->fecha);
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->year = $ventasPorMes[0]->anio;
                $fechaInicio->month = $ventasPorMes[0]->mes;
                $fechaFin->year = $ventasPorMes->last()->anio;
                $fechaFin->month = $ventasPorMes->last()->mes+1;
                $diferenciaTiempo = $fechaInicio->diffInMonths($fechaFin);
                //dd($fechaInicio,$fechaFin);

            }else{
                $arrayVariables['fechaInicio'] = new Carbon($request->fechaInicio);
                $arrayVariables['fechaFin'] = new Carbon($request->fechaFin);    
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                $diferenciaTiempo = $fechaInicio->diffInMonths($fechaFin);
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $ventasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];


        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['Mes']=$fechaInicio->year."/".$fechaInicio->month;
            $auxLLenar['cantidad'] = 0;//se inicia el arreglo con 0
            $ventasToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($ventasPorMes as $key => $mes) {
            $ventasToJson[$mes->anio."/".$mes->mes]['cantidad']=$mes->total;
        }
        //Fin de crear el arreglo

        $rows = array();   
        foreach ($ventasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $ventasToJson = ['cols' => $cols , 'rows' => $rows];


        $ventasToJson = json_encode($ventasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es enviada a la vista para las gráficas

        $arrayVariables['ventas'] = $ventasToJson;
        $arrayVariables['ventaTotal'] = $ventaTotal;
        $arrayVariables['promedio'] = $ventaTotal/$diferenciaTiempo;
        $arrayVariables['ventaMayor'] = $ventaMayor;
        $arrayVariables['ventaMenor'] = $ventaMenor;



        return json_encode($arrayVariables);

    }

    public function productosMasVendidos(Request $request){
        $productos =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idProducto','producto.nombre')
                    ->groupBy('idProducto')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $cols = [['id'=> 'Nombre','label'=> 'Nombre', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];
        $rows = array();
        foreach ($productos as $key => $producto) {
            array_push($rows, ['c'=> [ ['v' => $producto->nombre ] , ['v'=>$producto->total ] ]]);
        }
        $jsonGrafcas = ['cols' => $cols , 'rows' => $rows];            
        //dd(json_encode($rows ,JSON_NUMERIC_CHECK));

        return json_encode($jsonGrafcas);
    
    }

    public function ventasProductosPorSemana(Request $request){
        $productos =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idProducto','producto.nombre')
                    ->groupBy('idProducto')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de los 4 productos más vendidas

        $ProductoPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->whereIn('producto.id', $productos->pluck('idProducto')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idProducto','producto.nombre',DB::raw('YEAR(`fecha`) as anio'),'fecha')
            ->groupBy('idProducto')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($ProductoPorSemana[0])){
            if($request->fechaInicio=='0000-01-01'){
                $fechaInicio = new Carbon($ProductoPorSemana[0]->fecha);
                $fechaFin = new Carbon($ProductoPorSemana->last()->fecha);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);
            }else{
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->subWeek(1);          
            }
        }

        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $productosToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']=$fechaInicio->year."/".$fechaInicio->weekOfYear;
            foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las productos
            }
            $productosToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($ProductoPorSemana as $key => $producto) {
            $productosToJson[$producto->anio."/".$producto->semana][$producto->nombre]=$producto->total;
        }
        //Fin de crear el arreglo


        $rows = array();   
        foreach ($productosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $productosToJson = ['cols' => $cols , 'rows' => $rows];


        $productosToJson = json_encode($productosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es enviada a la vista para las gráficas

        return $productosToJson;

    }

    public function ventasProductosPorDia(Request $request){
        $productos =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idProducto','producto.nombre')
                    ->groupBy('idProducto')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de los 4 productos más vendidas

        $ProductosPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->whereIn('producto.id', $productos->pluck('idProducto')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('DAY(`fecha`) as dia'),'idProducto','producto.nombre',DB::raw('MONTH(`fecha`) as mes'))
            ->groupBy('idProducto')
            ->groupBy(DB::raw('MONTH(`fecha`)'))
            ->groupBy(DB::raw('DAY(`fecha`)'))//se hace el group by por el día en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($ProductosPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $ProductosPorDia[0]->dia;
                $fechaInicio->month = $ProductosPorDia[0]->mes;
                $fechaFin->day = $ProductosPorDia->last()->dia+1;
                $fechaFin->month = $ProductosPorDia->last()->mes;

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                
            }
        }
        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $ProductosToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']=$fechaInicio->month."/".$fechaInicio->day;
            foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Productos
            }
            $ProductosToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }

        foreach ($ProductosPorDia as $key => $Producto) {
            $ProductosToJson[$Producto->mes."/".$Producto->dia][$Producto->nombre]=$Producto->total;
        }
        // termina la creacion del arreglo


        $rows = array();   
        foreach ($ProductosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $ProductosToJson = ['cols' => $cols , 'rows' => $rows];


        $ProductosToJson = json_encode($ProductosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $ProductosToJson;

    }

    public function ventasProductosPorMes(Request $request){

        $productos =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idProducto','producto.nombre')
                    ->groupBy('idProducto')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de los 4 productos más vendidas

        $ProductosPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->whereIn('Producto.id', $productos->pluck('idProducto')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),'idProducto','producto.nombre',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idProducto')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($ProductosPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->year = $ProductosPorMes[0]->anio;
                $fechaInicio->month = $ProductosPorMes[0]->mes;
                $fechaFin->year = $ProductosPorMes->last()->anio;
                $fechaFin->month = $ProductosPorMes->last()->mes+1;

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                
            }
        }
        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $ProductosToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json

        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];// se crean el nombre de las columnas para la creación del json 
        foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['mes']=$fechaInicio->year."/".$fechaInicio->month;
            foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Productos
            }
            $ProductosToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($ProductosPorMes as $key => $Producto) {
            $ProductosToJson[$Producto->anio."/".$Producto->mes][$Producto->nombre]=$Producto->total;
        }
        // termina la creación del arreglo

        $rows = array();   
        foreach ($ProductosToJson as $key => $fila) {// aquí se convierte el arreglo creado anteriormente a formato de json para las gráficas de google
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $ProductosToJson = ['cols' => $cols , 'rows' => $rows];

        $ProductosToJson = json_encode($ProductosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $ProductosToJson;

    }

    public function ventasProductosPorHora(Request $request){
        //Se calculan las horas de búsqueda al rededor de un día
        $fechaInicio = new Carbon($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);

        $productos =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idProducto','producto.nombre')
                    ->groupBy('idProducto')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();
        //dd($productos);

        $ProductosPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->whereIn('Producto.id', $productos->pluck('idProducto')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),'idProducto','producto.nombre',DB::raw('DAY(`fecha`) as dia'))
            ->groupBy('idProducto')
            ->groupBy(DB::raw('DAY(`fecha`)'))
            ->groupBy(DB::raw('HOUR(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();


        $auxHora = array();//array auxiliar donde se guarda la información por Hora
        $numHora = 0; // variable para guardar la hora
        $ProductosToJson = array();// arreglo final donde se guardan los datos de todas las horas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string']];
        foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // este while crea un arreglo con posiciones reservadas por cada hora que se va a graficar en la vista, recorre hora por hora 
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            foreach ($productos->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Productos
            }
            $ProductosToJson[$fechaInicio->day."/".$fechaInicio->hour] = $auxLLenar;
            $fechaInicio->addHours(1);
        }

        foreach ($ProductosPorHora as $key => $Producto) {
            $ProductosToJson[$Producto->dia."/".$Producto->hora][$Producto->nombre]=$Producto->total;
        }



        $rows = array();   
        foreach ($ProductosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows, JSON_PRETTY_PRINT));
        $ProductosToJson = ['cols' => $cols , 'rows' => $rows];

        $ProductosToJson = json_encode($ProductosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $ProductosToJson;

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
        $categorias = Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<=',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('producto', 'venta.idProducto', '=', 'producto.id')
                    ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'idCategoria','categoria.nombre')
                    ->groupBy('idCategoria')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();// obtiene el id de las 4 categorias más vendidas

        $CategoriasPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<=',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('categoria', 'producto.idCategoria', '=', 'categoria.id')
            ->whereIn('categoria.id', $categorias->pluck('idCategoria')->toArray())
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idCategoria','categoria.nombre',DB::raw('YEAR(`fecha`) as anio'),'fecha')
            ->groupBy('idCategoria')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($CategoriasPorSemana[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($CategoriasPorSemana[0]->fecha);
                $fechaFin = new Carbon($CategoriasPorSemana->last()->fecha);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->subWeek(1);
                
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']=$fechaInicio->year."/".$fechaInicio->weekOfYear;
            foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
            }
            $categoriasToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($CategoriasPorSemana as $key => $categoria) {
            $categoriasToJson[$categoria->anio."/".$categoria->semana][$categoria->nombre]=$categoria->total;
        }
        //dd($CategoriasPorSemana);
        //Fin de crear el arreglo


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

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($CategoriasPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $CategoriasPorDia[0]->dia;
                $fechaInicio->month = $CategoriasPorDia[0]->mes;
                $fechaFin->day = $CategoriasPorDia->last()->dia+1;
                $fechaFin->month = $CategoriasPorDia->last()->mes;

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                
            }
        }
        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']=$fechaInicio->month."/".$fechaInicio->day;
            foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
            }
            $categoriasToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }

        foreach ($CategoriasPorDia as $key => $categoria) {
            $categoriasToJson[$categoria->mes."/".$categoria->dia][$categoria->nombre]=$categoria->total;
        }
        // termina la creacion del arreglo


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

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($CategoriasPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->year = $CategoriasPorMes[0]->anio;
                $fechaInicio->month = $CategoriasPorMes[0]->mes;
                $fechaFin->year = $CategoriasPorMes->last()->anio;
                $fechaFin->month = $CategoriasPorMes->last()->mes+1;

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                
            }
        }
        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $categoriasToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json

        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];// se crean el nombre de las columnas para la creación del json 
        foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['mes']=$fechaInicio->year."/".$fechaInicio->month;
            foreach ($categorias->pluck('nombre')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las categorias
            }
            $categoriasToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($CategoriasPorMes as $key => $categoria) {
            $categoriasToJson[$categoria->anio."/".$categoria->mes][$categoria->nombre]=$categoria->total;
        }
        // termina la creación del arreglo

        $rows = array();   
        foreach ($categoriasToJson as $key => $fila) {// aquí se convierte el arreglo creado anteriormente a formato de json para las gráficas de google
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

        foreach ($CategoriasPorHora as $key => $categoria) {
            $categoriasToJson[$categoria->dia."/".$categoria->hora][$categoria->nombre]=$categoria->total;
        }



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

    public function ventaMeserosTotal(Request $request){
        $Meseros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idMesero','nombrePersona')
            ->groupBy('idMesero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();

        $cols = [['id'=> 'Nombre','label'=> 'Nombre', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];
        $rows = array();
        foreach ($Meseros as $key => $Mesero) {
            array_push($rows, ['c'=> [ ['v' => $Mesero->nombrePersona ] , ['v'=>$Mesero->total ] ]]);
        }
        $jsonGrafcas = ['cols' => $cols , 'rows' => $rows];            
        //dd(json_encode($rows ,JSON_NUMERIC_CHECK));

        return json_encode($jsonGrafcas);
    
    }

    public function ventasMeserosPorSemana(Request $request){
        $Meseros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idMesero','nombrePersona')
            ->groupBy('idMesero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 meseros con  más ventas

        $MeserosPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<=',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Meseros->pluck('idMesero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idMesero','nombrePersona',DB::raw('YEAR(`fecha`) as anio'),'fecha')
            ->groupBy('idMesero')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($MeserosPorSemana[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($MeserosPorSemana[0]->fecha);
                $fechaFin = new Carbon($MeserosPorSemana->last()->fecha);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->subWeek(1);
                
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $MeserosToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']="Año:".$fechaInicio->year."/Semana:".$fechaInicio->weekOfYear;
            foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Meseros
            }
            $MeserosToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($MeserosPorSemana as $key => $Mesero) {
            $MeserosToJson[$Mesero->anio."/".$Mesero->semana][$Mesero->nombrePersona]=$Mesero->total;
        }
        //Fin de crear el arreglo


        $rows = array();   
        foreach ($MeserosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $MeserosToJson = ['cols' => $cols , 'rows' => $rows];


        $MeserosToJson = json_encode($MeserosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MeserosToJson;

    }

    public function ventasMeserosPorDia(Request $request){
        $Meseros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idMesero','nombrePersona')
            ->groupBy('idMesero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 meseros con  más ventas

        $MeserosPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Meseros->pluck('idMesero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('DAY(`fecha`) as dia'),'idMesero','usuario.nombrePersona',DB::raw('MONTH(`fecha`) as mes'))
            ->groupBy('idMesero')
            ->groupBy(DB::raw('MONTH(`fecha`)'))
            ->groupBy(DB::raw('DAY(`fecha`)'))//se hace el group by por el día en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($MeserosPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $MeserosPorDia[0]->dia;
                $fechaInicio->month = $MeserosPorDia[0]->mes;
                $fechaFin->day = $MeserosPorDia->last()->dia+1;
                $fechaFin->month = $MeserosPorDia->last()->mes;

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                
            }
        }
        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $MeserosToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']="Mes: ".$fechaInicio->month."/Día: ".$fechaInicio->day;
            foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Meseros
            }
            $MeserosToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }

        foreach ($MeserosPorDia as $key => $Mesero) {
            $MeserosToJson[$Mesero->mes."/".$Mesero->dia][$Mesero->nombrePersona]=$Mesero->total;
        }
        // termina la creacion del arreglo


        $rows = array();   
        foreach ($MeserosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $MeserosToJson = ['cols' => $cols , 'rows' => $rows];


        $MeserosToJson = json_encode($MeserosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MeserosToJson;

    }

    public function ventasMeserosPorMes(Request $request){
        $Meseros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idMesero','nombrePersona')
            ->groupBy('idMesero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 meseros con  más ventas

        $MeserosPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Meseros->pluck('idMesero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),'idMesero','usuario.nombrePersona',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idMesero')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($MeserosPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->year = $MeserosPorMes[0]->anio;
                $fechaInicio->month = $MeserosPorMes[0]->mes;
                $fechaFin->year = $MeserosPorMes->last()->anio;
                $fechaFin->month = $MeserosPorMes->last()->mes+1;

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                
            }
        }
        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $MeserosToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json

        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];// se crean el nombre de las columnas para la creación del json 
        foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['mes']=$fechaInicio->year."/".$fechaInicio->month;
            foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Meseros
            }
            $MeserosToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($MeserosPorMes as $key => $Mesero) {
            $MeserosToJson[$Mesero->anio."/".$Mesero->mes][$Mesero->nombrePersona]=$Mesero->total;
        }
        // termina la creación del arreglo

        $rows = array();   
        foreach ($MeserosToJson as $key => $fila) {// aquí se convierte el arreglo creado anteriormente a formato de json para las gráficas de google
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $MeserosToJson = ['cols' => $cols , 'rows' => $rows];

        $MeserosToJson = json_encode($MeserosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MeserosToJson;

    }

    public function ventasMeserosPorHora(Request $request){
        //Se calculan las horas de búsqueda al rededor de un día
        $fechaInicio = new Carbon($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);

        $Meseros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idMesero','nombrePersona')
            ->groupBy('idMesero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 meseros con  más ventas

        $MeserosPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idMesero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Meseros->pluck('idMesero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),'idMesero','usuario.nombrePersona',DB::raw('DAY(`fecha`) as dia'))
            ->groupBy('idMesero')
            ->groupBy(DB::raw('DAY(`fecha`)'))
            ->groupBy(DB::raw('HOUR(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();


        $auxHora = array();//array auxiliar donde se guarda la información por Hora
        $numHora = 0; // variable para guardar la hora
        $MeserosToJson = array();// arreglo final donde se guardan los datos de todas las horas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string']];
        foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // este while crea un arreglo con posiciones reservadas por cada hora que se va a graficar en la vista, recorre hora por hora 
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            foreach ($Meseros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Meseros
            }
            $MeserosToJson[$fechaInicio->day."/".$fechaInicio->hour] = $auxLLenar;
            $fechaInicio->addHours(1);
        }

        foreach ($MeserosPorHora as $key => $Mesero) {
            $MeserosToJson[$Mesero->dia."/".$Mesero->hora][$Mesero->nombrePersona]=$Mesero->total;
        }



        $rows = array();   
        foreach ($MeserosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows, JSON_PRETTY_PRINT));
        $MeserosToJson = ['cols' => $cols , 'rows' => $rows];

        $MeserosToJson = json_encode($MeserosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MeserosToJson;

    }

    public function ventaBartenderTotal(Request $request){
        $Bartender =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idBartender','nombrePersona')
            ->groupBy('idBartender')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();

        $cols = [['id'=> 'Nombre','label'=> 'Nombre', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];
        $rows = array();
        foreach ($Bartender as $key => $Bartender) {
            array_push($rows, ['c'=> [ ['v' => $Bartender->nombrePersona ] , ['v'=>$Bartender->total ] ]]);
        }
        $jsonGrafcas = ['cols' => $cols , 'rows' => $rows];            
        //dd(json_encode($rows ,JSON_NUMERIC_CHECK));

        return json_encode($jsonGrafcas);
    
    }

    public function ventasBartenderPorSemana(Request $request){
        $Bartender =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idBartender','nombrePersona')
            ->groupBy('idBartender')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Bartender con  más ventas

        $BartenderPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<=',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->whereIn('usuario.id', $Bartender->pluck('idBartender')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idBartender','nombrePersona',DB::raw('YEAR(`fecha`) as anio'),'fecha')
            ->groupBy('idBartender')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($BartenderPorSemana[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($BartenderPorSemana[0]->fecha);
                $fechaFin = new Carbon($BartenderPorSemana->last()->fecha);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->subWeek(1);
                
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $BartenderToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']="Año:".$fechaInicio->year."/Semana:".$fechaInicio->weekOfYear;
            foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Bartender
            }
            $BartenderToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($BartenderPorSemana as $key => $Bartender) {
            $BartenderToJson[$Bartender->anio."/".$Bartender->semana][$Bartender->nombrePersona]=$Bartender->total;
        }
        //Fin de crear el arreglo


        $rows = array();   
        foreach ($BartenderToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $BartenderToJson = ['cols' => $cols , 'rows' => $rows];


        $BartenderToJson = json_encode($BartenderToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $BartenderToJson;

    }

    public function ventasBartenderPorDia(Request $request){
        $Bartender =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idBartender','nombrePersona')
            ->groupBy('idBartender')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Bartender con  más ventas

        $BartenderPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->whereIn('usuario.id', $Bartender->pluck('idBartender')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('DAY(`fecha`) as dia'),'idBartender','usuario.nombrePersona',DB::raw('MONTH(`fecha`) as mes'))
            ->groupBy('idBartender')
            ->groupBy(DB::raw('MONTH(`fecha`)'))
            ->groupBy(DB::raw('DAY(`fecha`)'))//se hace el group by por el día en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($BartenderPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $BartenderPorDia[0]->dia;
                $fechaInicio->month = $BartenderPorDia[0]->mes;
                $fechaFin->day = $BartenderPorDia->last()->dia+1;
                $fechaFin->month = $BartenderPorDia->last()->mes;

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                
            }
        }
        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $BartenderToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']="Mes: ".$fechaInicio->month."/Día: ".$fechaInicio->day;
            foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Bartender
            }
            $BartenderToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }

        foreach ($BartenderPorDia as $key => $Bartender) {
            $BartenderToJson[$Bartender->mes."/".$Bartender->dia][$Bartender->nombrePersona]=$Bartender->total;
        }
        // termina la creacion del arreglo


        $rows = array();   
        foreach ($BartenderToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $BartenderToJson = ['cols' => $cols , 'rows' => $rows];


        $BartenderToJson = json_encode($BartenderToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $BartenderToJson;

    }

    public function ventasBartenderPorMes(Request $request){
        $Bartender =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idBartender','nombrePersona')
            ->groupBy('idBartender')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Bartender con  más ventas

        $BartenderPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->whereIn('usuario.id', $Bartender->pluck('idBartender')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),'idBartender','usuario.nombrePersona',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idBartender')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($BartenderPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->year = $BartenderPorMes[0]->anio;
                $fechaInicio->month = $BartenderPorMes[0]->mes;
                $fechaFin->year = $BartenderPorMes->last()->anio;
                $fechaFin->month = $BartenderPorMes->last()->mes+1;

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                
            }
        }
        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $BartenderToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json

        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];// se crean el nombre de las columnas para la creación del json 
        foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['mes']=$fechaInicio->year."/".$fechaInicio->month;
            foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Bartender
            }
            $BartenderToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($BartenderPorMes as $key => $Bartender) {
            $BartenderToJson[$Bartender->anio."/".$Bartender->mes][$Bartender->nombrePersona]=$Bartender->total;
        }
        // termina la creación del arreglo

        $rows = array();   
        foreach ($BartenderToJson as $key => $fila) {// aquí se convierte el arreglo creado anteriormente a formato de json para las gráficas de google
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $BartenderToJson = ['cols' => $cols , 'rows' => $rows];

        $BartenderToJson = json_encode($BartenderToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $BartenderToJson;

    }

    public function ventasBartenderPorHora(Request $request){
        //Se calculan las horas de búsqueda al rededor de un día
        $fechaInicio = new Carbon($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);

        $Bartender =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idBartender','nombrePersona')
            ->groupBy('idBartender')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Bartender con  más ventas

        $BartenderPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idBartender', '=', 'usuario.id')
            ->whereIn('usuario.id', $Bartender->pluck('idBartender')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),'idBartender','usuario.nombrePersona',DB::raw('DAY(`fecha`) as dia'))
            ->groupBy('idBartender')
            ->groupBy(DB::raw('DAY(`fecha`)'))
            ->groupBy(DB::raw('HOUR(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();


        $auxHora = array();//array auxiliar donde se guarda la información por Hora
        $numHora = 0; // variable para guardar la hora
        $BartenderToJson = array();// arreglo final donde se guardan los datos de todas las horas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string']];
        foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // este while crea un arreglo con posiciones reservadas por cada hora que se va a graficar en la vista, recorre hora por hora 
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            foreach ($Bartender->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Bartender
            }
            $BartenderToJson[$fechaInicio->day."/".$fechaInicio->hour] = $auxLLenar;
            $fechaInicio->addHours(1);
        }

        foreach ($BartenderPorHora as $key => $Bartender) {
            $BartenderToJson[$Bartender->dia."/".$Bartender->hora][$Bartender->nombrePersona]=$Bartender->total;
        }



        $rows = array();   
        foreach ($BartenderToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows, JSON_PRETTY_PRINT));
        $BartenderToJson = ['cols' => $cols , 'rows' => $rows];

        $BartenderToJson = json_encode($BartenderToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $BartenderToJson;

    }

    public function ventaCajerosTotal(Request $request){
        $Cajeros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idCajero','nombrePersona')
            ->groupBy('idCajero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();

        $cols = [['id'=> 'Nombre','label'=> 'Nombre', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];
        $rows = array();
        foreach ($Cajeros as $key => $Cajeros) {
            array_push($rows, ['c'=> [ ['v' => $Cajeros->nombrePersona ] , ['v'=>$Cajeros->total ] ]]);
        }
        $jsonGrafcas = ['cols' => $cols , 'rows' => $rows];            
        //dd(json_encode($rows ,JSON_NUMERIC_CHECK));

        return json_encode($jsonGrafcas);
    
    }

    public function ventasCajerosPorSemana(Request $request){
        $Cajeros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idCajero','nombrePersona')
            ->groupBy('idCajero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Cajeros con  más ventas

        $CajerosPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<=',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Cajeros->pluck('idCajero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('WEEK(`fecha`) as semana'),'idCajero','nombrePersona',DB::raw('YEAR(`fecha`) as anio'),'fecha')
            ->groupBy('idCajero')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($CajerosPorSemana[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($CajerosPorSemana[0]->fecha);
                $fechaFin = new Carbon($CajerosPorSemana->last()->fecha);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->subWeek(1);
                
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $CajerosToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']="Año:".$fechaInicio->year."/Semana:".$fechaInicio->weekOfYear;
            foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Cajeros
            }
            $CajerosToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($CajerosPorSemana as $key => $Cajeros) {
            $CajerosToJson[$Cajeros->anio."/".$Cajeros->semana][$Cajeros->nombrePersona]=$Cajeros->total;
        }
        //Fin de crear el arreglo


        $rows = array();   
        foreach ($CajerosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $CajerosToJson = ['cols' => $cols , 'rows' => $rows];


        $CajerosToJson = json_encode($CajerosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $CajerosToJson;

    }

    public function ventasCajerosPorDia(Request $request){
        $Cajeros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idCajero','nombrePersona')
            ->groupBy('idCajero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Cajeros con  más ventas

        $CajerosPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Cajeros->pluck('idCajero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('DAY(`fecha`) as dia'),'idCajero','usuario.nombrePersona',DB::raw('MONTH(`fecha`) as mes'))
            ->groupBy('idCajero')
            ->groupBy(DB::raw('MONTH(`fecha`)'))
            ->groupBy(DB::raw('DAY(`fecha`)'))//se hace el group by por el día en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($CajerosPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $CajerosPorDia[0]->dia;
                $fechaInicio->month = $CajerosPorDia[0]->mes;
                $fechaFin->day = $CajerosPorDia->last()->dia+1;
                $fechaFin->month = $CajerosPorDia->last()->mes;

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                
            }
        }
        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $CajerosToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']="Mes: ".$fechaInicio->month."/Día: ".$fechaInicio->day;
            foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Cajeros
            }
            $CajerosToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }

        foreach ($CajerosPorDia as $key => $Cajeros) {
            $CajerosToJson[$Cajeros->mes."/".$Cajeros->dia][$Cajeros->nombrePersona]=$Cajeros->total;
        }
        // termina la creacion del arreglo


        $rows = array();   
        foreach ($CajerosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $CajerosToJson = ['cols' => $cols , 'rows' => $rows];


        $CajerosToJson = json_encode($CajerosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $CajerosToJson;

    }

    public function ventasCajerosPorMes(Request $request){
        $Cajeros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idCajero','nombrePersona')
            ->groupBy('idCajero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Cajeros con  más ventas

        $CajerosPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Cajeros->pluck('idCajero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),'idCajero','usuario.nombrePersona',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idCajero')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($CajerosPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->year = $CajerosPorMes[0]->anio;
                $fechaInicio->month = $CajerosPorMes[0]->mes;
                $fechaFin->year = $CajerosPorMes->last()->anio;
                $fechaFin->month = $CajerosPorMes->last()->mes+1;

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                
            }
        }
        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $CajerosToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json

        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];// se crean el nombre de las columnas para la creación del json 
        foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['mes']=$fechaInicio->year."/".$fechaInicio->month;
            foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Cajeros
            }
            $CajerosToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($CajerosPorMes as $key => $Cajeros) {
            $CajerosToJson[$Cajeros->anio."/".$Cajeros->mes][$Cajeros->nombrePersona]=$Cajeros->total;
        }
        // termina la creación del arreglo

        $rows = array();   
        foreach ($CajerosToJson as $key => $fila) {// aquí se convierte el arreglo creado anteriormente a formato de json para las gráficas de google
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $CajerosToJson = ['cols' => $cols , 'rows' => $rows];

        $CajerosToJson = json_encode($CajerosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $CajerosToJson;

    }

    public function ventasCajerosPorHora(Request $request){
        //Se calculan las horas de búsqueda al rededor de un día
        $fechaInicio = new Carbon($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);

        $Cajeros =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),'idCajero','nombrePersona')
            ->groupBy('idCajero')
            ->orderBy('total', 'DESC')
            ->limit(4)
            ->get();// obtiene el id de los 4 Cajeros con  más ventas

        $CajerosPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('producto', 'venta.idProducto', '=', 'producto.id')
            ->join('usuario', 'venta.idCajero', '=', 'usuario.id')
            ->whereIn('usuario.id', $Cajeros->pluck('idCajero')->toArray())
            ->select(DB::raw('SUM(`precio`*`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),'idCajero','usuario.nombrePersona',DB::raw('DAY(`fecha`) as dia'))
            ->groupBy('idCajero')
            ->groupBy(DB::raw('DAY(`fecha`)'))
            ->groupBy(DB::raw('HOUR(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();


        $auxHora = array();//array auxiliar donde se guarda la información por Hora
        $numHora = 0; // variable para guardar la hora
        $CajerosToJson = array();// arreglo final donde se guardan los datos de todas las horas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string']];
        foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // este while crea un arreglo con posiciones reservadas por cada hora que se va a graficar en la vista, recorre hora por hora 
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            foreach ($Cajeros->pluck('nombrePersona')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Cajeros
            }
            $CajerosToJson[$fechaInicio->day."/".$fechaInicio->hour] = $auxLLenar;
            $fechaInicio->addHours(1);
        }

        foreach ($CajerosPorHora as $key => $Cajeros) {
            $CajerosToJson[$Cajeros->dia."/".$Cajeros->hora][$Cajeros->nombrePersona]=$Cajeros->total;
        }



        $rows = array();   
        foreach ($CajerosToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows, JSON_PRETTY_PRINT));
        $CajerosToJson = ['cols' => $cols , 'rows' => $rows];

        $CajerosToJson = json_encode($CajerosToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $CajerosToJson;

    }

    public function MesasQueMasVenden(Request $request){
        $mesas =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa')
                    ->groupBy('factura.idMesa')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $cols = [['id'=> 'Nombre','label'=> 'Nombre', 'type'=> 'string'],['id'=> 'Cantidad','label'=> 'Cantidad', 'type'=> 'number']];
        $rows = array();
        foreach ($mesas as $key => $mesa) {
            array_push($rows, ['c'=> [ ['v' => $mesa->nombreMesa ] , ['v'=>$mesa->total ] ]]);
        }
        $jsonGrafcas = ['cols' => $cols , 'rows' => $rows];            
        //dd(json_encode($rows ,JSON_NUMERIC_CHECK));

        return json_encode($jsonGrafcas);
    
    }

    public function ventasMesasPorHora(Request $request){
        //Se calculan las horas de búsqueda al rededor de un día
        $fechaInicio = new Carbon($request->fechaInicio);
        $fechaFin = new Carbon($request->fechaInicio);
        $fechaInicio->startOfDay()->subHours(6);
        $fechaFin->startOfDay()->addHours(30);

        $Mesas =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa')
                    ->groupBy('factura.idMesa')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $MesasPorHora = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$fechaInicio],['factura.fecha','<',$fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->whereIn('mesa.id', $Mesas->pluck('idMesa')->toArray())                    
            ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa',DB::raw('HOUR(`fecha`) as hora'),DB::raw('DAY(`fecha`) as dia'))
            ->groupBy('idMesa')
            ->groupBy(DB::raw('DAY(`fecha`)'))
            ->groupBy(DB::raw('HOUR(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();


        $auxHora = array();//array auxiliar donde se guarda la información por Hora
        $numHora = 0; // variable para guardar la hora
        $MesasToJson = array();// arreglo final donde se guardan los datos de todas las horas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Hora','label'=> 'Hora', 'type'=> 'string']];
        foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // este while crea un arreglo con posiciones reservadas por cada hora que se va a graficar en la vista, recorre hora por hora 
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['hora']=$fechaInicio->day."/".$fechaInicio->hour.":00";
            foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Mesas
            }
            $MesasToJson[$fechaInicio->day."/".$fechaInicio->hour] = $auxLLenar;
            $fechaInicio->addHours(1);
        }

        foreach ($MesasPorHora as $key => $Mesas) {
            $MesasToJson[$Mesas->dia."/".$Mesas->hora][$Mesas->nombreMesa]=$Mesas->total;
        }



        $rows = array();   
        foreach ($MesasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows, JSON_PRETTY_PRINT));
        $MesasToJson = ['cols' => $cols , 'rows' => $rows];

        $MesasToJson = json_encode($MesasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MesasToJson;

    }

    public function ventasMesasPorMes(Request $request){
        $Mesas =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa')
                    ->groupBy('factura.idMesa')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $MesasPorMes = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->whereIn('mesa.id', $Mesas->pluck('idMesa')->toArray())                    
            ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa',DB::raw('MONTH(`fecha`) as mes'),DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idMesa')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($MesasPorMes[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->year = $MesasPorMes[0]->anio;
                $fechaInicio->month = $MesasPorMes[0]->mes;
                $fechaFin->year = $MesasPorMes->last()->anio;
                $fechaFin->month = $MesasPorMes->last()->mes+1;

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaInicio->subMonth(1);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaFin->addMonth(1);
                
            }
        }
        $auxMes = array();//array auxiliar donde se guarda la información por Mes
        $numMes = 0; // variable para guardar el numero del Mes
        $MesasToJson = array();// arreglo final donde se guardan los datos de todas los meses, para despues convertirlo a formato Json

        $cols = [['id'=> 'Mes','label'=> 'Mes', 'type'=> 'string']];// se crean el nombre de las columnas para la creación del json 
        foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['mes']=$fechaInicio->year."/".$fechaInicio->month;
            foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Mesas
            }
            $MesasToJson[$fechaInicio->year."/".$fechaInicio->month] = $auxLLenar;
            $fechaInicio->addMonth(1);
        }
        foreach ($MesasPorMes as $key => $Mesas) {
            $MesasToJson[$Mesas->anio."/".$Mesas->mes][$Mesas->nombreMesa]=$Mesas->total;
        }
          // termina la creación del arreglo

        $rows = array();   
        foreach ($MesasToJson as $key => $fila) {// aquí se convierte el arreglo creado anteriormente a formato de json para las gráficas de google
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $MesasToJson = ['cols' => $cols , 'rows' => $rows];

        $MesasToJson = json_encode($MesasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MesasToJson;

    }

    public function ventasMesasPorDia(Request $request){
        $Mesas =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa')
                    ->groupBy('factura.idMesa')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $MesasPorDia = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->whereIn('mesa.id', $Mesas->pluck('idMesa')->toArray())                    
            ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa',DB::raw('DAY(`fecha`) as dia'),DB::raw('MONTH(`fecha`) as mes'))
            ->groupBy('idMesa')
            ->groupBy(DB::raw('MONTH(`fecha`)'))
            ->groupBy(DB::raw('DAY(`fecha`)'))//se hace el group by por el día en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($MesasPorDia[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon();
                $fechaFin = new Carbon();
                $fechaInicio->day = $MesasPorDia[0]->dia;
                $fechaInicio->month = $MesasPorDia[0]->mes;
                $fechaFin->day = $MesasPorDia->last()->dia+1;
                $fechaFin->month = $MesasPorDia->last()->mes;

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                
            }
        }
        $auxDia = array();//array auxiliar donde se guarda la información por día
        $numDia = 0; // variable para guardar el numero del día
        $MesasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Dia','label'=> 'Día', 'type'=> 'string']];
        foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['dia']="Mes: ".$fechaInicio->month."/Día: ".$fechaInicio->day;
            foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Mesas
            }
            $MesasToJson[$fechaInicio->month."/".$fechaInicio->day] = $auxLLenar;
            $fechaInicio->addDay(1);
        }

        foreach ($MesasPorDia as $key => $Mesas) {
            $MesasToJson[$Mesas->mes."/".$Mesas->dia][$Mesas->nombreMesa]=$Mesas->total;
        }
        // termina la creacion del arreglo


        $rows = array();   
        foreach ($MesasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $MesasToJson = ['cols' => $cols , 'rows' => $rows];


        $MesasToJson = json_encode($MesasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MesasToJson;

    }

    public function ventasMesasPorSemana(Request $request){
        $Mesas =  Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
                    ->join('venta', 'factura.id', '=', 'venta.idFactura')
                    ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
                    ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa')
                    ->groupBy('factura.idMesa')
                    ->orderBy('total', 'DESC')
                    ->limit(4)
                    ->get();

        $MesasPorSemana = Factura::where([['factura.estado', 'Finalizada'],['factura.fecha','>=',$request->fechaInicio],['factura.fecha','<',$request->fechaFin]])
            ->join('venta', 'factura.id', '=', 'venta.idFactura')
            ->join('mesa', 'factura.idMesa', '=', 'mesa.id')
            ->whereIn('mesa.id', $Mesas->pluck('idMesa')->toArray())                    
            ->select(DB::raw('SUM(`cantidad`) as total'),'factura.idMesa','mesa.nombreMesa',DB::raw('WEEK(`fecha`) as semana'),DB::raw('YEAR(`fecha`) as anio'),'fecha')
            ->groupBy('idMesa')
            ->groupBy(DB::raw('WEEK(`fecha`)'))//se hace el group by por la semana del año en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
        $fechaInicio =  Carbon::now();
        $fechaFin =  Carbon::now();
        if(isset($MesasPorSemana[0])){
            if($request->fechaInicio=='0000-01-01'){
                
                $fechaInicio = new Carbon($MesasPorSemana[0]->fecha);
                $fechaFin = new Carbon($MesasPorSemana->last()->fecha);
                $fechaFin->addWeek(1);
                $fechaInicio->subWeek(1);

                //dd($fechaInicio,$fechaFin);

            }else{
        
                $fechaInicio = new Carbon($request->fechaInicio);
                $fechaFin = new Carbon($request->fechaFin);
                $fechaInicio->subWeek(1);
                
            }
        }
        $auxSemana = array();//array auxiliar donde se guarda la información por semana
        $numSemana = 0; // variable para guardar el numero de la semana
        $MesasToJson = array();// arreglo final donde se guardan los datos de todas las semanas, para despues convertirlo a formato Json
        $cols = [['id'=> 'Semana','label'=> 'Semana', 'type'=> 'string']];
        foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
            array_push($cols , ['id'=> 'Cantidad'.$nombre,'label'=> $nombre, 'type'=> 'number']);
        }

        // se crean un arreglo con todos los datos
        while ($fechaInicio->lessThan($fechaFin)) {
            $auxLLenar = array();
            $auxLLenar['semana']="Año:".$fechaInicio->year."/Semana:".$fechaInicio->weekOfYear;
            foreach ($Mesas->pluck('nombreMesa')->toArray() as $key => $nombre) {
                $auxLLenar[$nombre] = 0;//se inicia el arreglo con los nombres de las Mesas
            }
            $MesasToJson[$fechaInicio->year."/".$fechaInicio->weekOfYear] = $auxLLenar;
            $fechaInicio->addWeek(1);
        }
        foreach ($MesasPorSemana as $key => $Mesas) {
            $MesasToJson[$Mesas->anio."/".$Mesas->semana][$Mesas->nombreMesa]=$Mesas->total;
        }
        //Fin de crear el arreglo


        $rows = array();   
        foreach ($MesasToJson as $key => $fila) {
            $auxRow = array();
            foreach ($fila as $key => $valor) {
                array_push($auxRow,['v' => $valor ]);    
            }
            array_push($rows, ['c'=>  $auxRow]);                
        }

        //dd(json_encode($rows));
        $MesasToJson = ['cols' => $cols , 'rows' => $rows];


        $MesasToJson = json_encode($MesasToJson,JSON_NUMERIC_CHECK);// el arreglo se convierte a formato json, esta variable es anviada a la vista para las gráficas

        return $MesasToJson;

    }
} 




