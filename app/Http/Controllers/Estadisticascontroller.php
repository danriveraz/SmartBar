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

        $productos = $this->productosMasVendidos($request);// obtiene el id de los 4 productos más vendidos
        $productosSemana = $this->ventasProductosPorSemana($request);//Llamado a la función para el comportamiento de ventas por semana de los producto
        $productosDia = $this->ventasProductosPorDia($request);
        $productosMes = $this->ventasProductosPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de los productos
        $categorias = $this->categoriasMasVendidas($request);// obtiene el id de las 4 categorias más vendida
        $categoriasSemana = $this->ventasCategoriasPorSemana($request);//Llamado a la función para el comportamiento de ventas por semana de las categorias
        $categoriasDia = $this->ventasCategoriasPorDia($request);//Llamado a la función para el comportamiento de ventas por Dia de las categorias
        $categoriasMes = $this->ventasCategoriasPorMes($request);//Llamado a la función para el comportamiento de ventas por Mes de las categorias

        $request->request->add(['fechaInicio' => Carbon::now()]);
        $categoriasHora = $this->ventasCategoriasPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de las categorias
        $productosHora = $this->ventasProductosPorHora($request);//Llamado a la función para el comportamiento de ventas por Día de los productos


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
            ->with('productosVentasPorHora',$productosHora);
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
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('MONTH(`fecha`) as mes'),'idProducto','Producto.nombre',DB::raw('YEAR(`fecha`) as anio'))
            ->groupBy('idProducto')
            ->groupBy(DB::raw('YEAR(`fecha`)'))
            ->groupBy(DB::raw('MONTH(`fecha`)'))//se hace el group by por el mes en que fue realizada la factura
            ->orderBy('fecha', 'ASC')
            ->get();

        //organizar las fechas, para el rango a mostrar
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
            ->select(DB::raw('SUM(`cantidad`) as total'),DB::raw('HOUR(`fecha`) as hora'),'idProducto','Producto.nombre',DB::raw('DAY(`fecha`) as dia'))
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


} 




