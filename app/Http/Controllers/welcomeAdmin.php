<?php

namespace PocketByR\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PocketByR\Http\Requests;
use PocketByR\Http\Controllers\Controller;
use PocketByR\Producto;
use PocketByR\Notificaciones;
use PocketByR\Contiene;
use PocketByR\Insumo;
use PocketByR\Categoria;
use PocketByR\User;
use PocketByR\Factura;
use PocketByR\Venta;
use PocketByR\Mesa;
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

        $notificaciones = Notificaciones::Usuario(Auth::id())->get();
        $nuevas = 0;
        $fechaActual = Carbon::now();
        $fecha2array = array();
        for ($i=0; $i < sizeof($notificaciones); $i++) {
          if($notificaciones[$i]->estado == "nueva"){
            $nuevas = $nuevas + 1;
          }
          $fechaNotificacion = Carbon::parse($notificaciones[$i]->fecha);
          $diferencia = $fechaActual->diffInDays($fechaNotificacion,true);
          array_push($fecha2array, array($notificaciones[$i]->id, $diferencia));
        }

        $flag = false;
        $userActual = Auth::user();
        if(Factura::where([['factura.estado', 'Finalizada'],['factura.idEmpresa', Auth::user()->empresaActual]])->first()!= null) {
            $categoriasMasVendidas = $this->categoriasMasVendidas();// llamado a la función queretorna un arreglo con dos valores

            //ESTADISTICAS DEL DÍA 
            //Utilidad 
            $utilidadHoy = 0;
            $facturasHoy = Factura::listarFacturaDia(Auth::user()->empresaActual)->get();
            for ($i=0; $i < sizeof($facturasHoy); $i++) { 
                $ventas = Venta::listarElementosId($facturasHoy[$i]->id)->get();
                for ($j=0; $j < sizeof($ventas); $j++) { 
                    $contiene = Contiene::idProducto($ventas[$j]->idProducto)->get();
                    for ($k=0; $k < sizeof($contiene); $k++) { 
                        $insumo = Insumo::find($contiene[$k]->idInsumo);
                        $utilidad = 0;
                        if($insumo->esProducto){
                            $utilidad = $insumo->valorCompra - $insumo->precioUnidad;
                            $utilidadHoy = $utilidadHoy + $utilidad;
                        }else{//validación si es bar o restaurante falta
                            $producto = Producto::find($contiene[$k]->idProducto);
                            $costoXonza = ($contiene[$k]->cantidad)/$insumo->valorCompra;
                            $ventaXonza = ($contiene[$k]->cantidad)/$insumo->precioUnidad;
                            $utilidad = $producto->precio - ($contiene[$k]->cantidad)/$insumo->valorCompra;
                            $utilidadHoy = $utilidadHoy + $utilidad;
                        }
                    }
                }
            }   
            //Ventas por vendedor
            $vendedores = array();
            $vendedorArray[] = ['Nombre', 'Total venta'];
            $meserosAux = User::searchUsers(Auth::user()->empresaActual)->get();
            for ($i=0; $i < sizeof($facturasHoy); $i++) {
                $facturAux = Factura::find($facturasHoy[$i]->id);
                $boolean = 0;
                for ($j=0; $j < sizeof($vendedores); $j++) { 
                    if($vendedores[$j][0] == $facturAux->idUsuario){
                        $vendedores[$j][2] = $vendedores[$j][2] + $facturAux->total;
                        $boolean = 1;
                    }
                }
                if($boolean == 0){
                    for ($j=0; $j < sizeof($meserosAux) ; $j++) { 
                        if($meserosAux[$j]->id == $facturAux->idUsuario){
                            //dd($meserosAux[$j]->id);
                            array_push($vendedores, array($meserosAux[$j]->id, $meserosAux[$j]->nombrePersona, $facturAux->total)); 
                            //dd($vendedores);
                        }
                    }
                }
            }
            for ($i=0; $i < sizeof($vendedores); $i++) { 
                $vendedorArray[$i+1] = [$vendedores[$i][1], $vendedores[$i][2]];
            }
            //Mesas reservadas si hay
            $mesasReservadas = Mesa::mesasReservadas(Auth::user()->empresaActual)->get();
            $nMesasReservadas = sizeof($mesasReservadas);
            //Personal trabajando hoy

            //Flujo de personas
            $flujoPersonas = 0;
            for ($i=0; $i < sizeof($facturasHoy); $i++) { 
                $facturAux = Factura::find($facturasHoy[$i]->id);
                $flujoPersonas = $flujoPersonas + $facturAux->nPersonas;
            }

            //Mesa que más vende
            $mesasMayores = array(); // Retorna la mesa que más vende
            $mesaArray[] = ['Nombre','Total venta'];
            $mesasAux = Mesa::mesasAdmin(Auth::user()->empresaActual)->get();
            for ($i=0; $i < sizeof($facturasHoy); $i++) {
                $facturAux = Factura::find($facturasHoy[$i]->id);
                $boolean = 0;
                for ($j=0; $j < sizeof($mesasMayores); $j++) { 
                    if($mesasMayores[$j][0] == $facturAux->idMesa){
                        $mesasMayores[$j][2] = $mesasMayores[$j][2] + $facturAux->total;
                        $boolean = 1;
                    }
                }
                if($boolean == 0){
                    for ($j=0; $j < sizeof($mesasAux) ; $j++) { 
                        if($mesasAux[$j]->id == $facturAux->idMesa){
                            array_push($mesasMayores, array($mesasAux[$j]->id, $mesasAux[$j]->nombreMesa, $facturAux->total)); 
                        }
                    }
                }
            }

            function mesaSorting($a, $b){
                $t1 = $a['1'];
                $t2 = $b['1'];
                if($t1 > $t2) return 1;
                else return 0;
            }
            usort($mesasMayores, function($a, $b){
                $t1 = $a['1'];
                $t2 = $b['1'];
                if($t1 < $t2) return 1;
                else return 0;
            });

            for ($i=0; $i < sizeof($mesasMayores); $i++) { 
                $mesaArray[$i+1] = [$mesasMayores[$i][1], $mesasMayores[$i][2]];
            }
            //FIN ESTADISTICAS DEL DÍA

            $ventaTotal = Factura::totalEnTodasLasVentas(Auth::user()->empresaActual)->first();// la venta en todos los tiempo, para poder sacar el porcentaje de ventas
            $meserosMasVendedores =  Factura::ventasMesero(Auth::user()->empresaActual,$ventaTotal->totalVentas)->get();//Top 10meseros
            $bartenderMasVendedores =  Factura::ventasBartender(Auth::user()->empresaActual,$ventaTotal->totalVentas)->get();//Top 10 Bartender
            $cajeroMasVendedores =  Factura::ventasCajero(Auth::user()->empresaActual,$ventaTotal->totalVentas)->get(); // top 10 cajeros

            $ventasDelDia = $this->ventaDelDia();// llamado a la función para obtener lo que se ha vendido en el día

            $cantidadVentasDelDia = $this->cantidadVentasDelDia(); // llamado a la función para obtener la cantidad de ventas del día

            $ventasSemana  = $this->VentasSemana();// Lamado a la función que ontener los datos de la semana actual y la semana anterior, para la tabla de comparación

            $datosVentasComparacionSemanas = $this->ventaCadaDiaSemana();// venta de la semana pasada y actual, detallada en cada día 

            $mesasConMasVentas =  Factura::mesasConMasVentas(Auth::user()->empresaActual,$ventaTotal->totalVentas)->limit(4)->get(); // consulta de las 4 mesas en las que más se ha vendido
            return View('WelcomeAdmin/welcome')->with('categoriasMasVendidas',$categoriasMasVendidas['categoriasMasVendidas'])
                    ->with('sumaVentasDeCadaCategoria',$categoriasMasVendidas['sumaVentasDeCadaCategoria'])
                    ->with('meserosMasVendedores',$meserosMasVendedores)
                    ->with('bartenderMasVendedores',$bartenderMasVendedores)
                    ->with('cajeroMasVendedores',$cajeroMasVendedores)
                    ->with('ventasDelDia',$ventasDelDia)
                    ->with('cantidadVentas',$cantidadVentasDelDia)
                    ->with('ventasSemana', $ventasSemana)
                    ->with('datosVentasComparacionSemanas',$datosVentasComparacionSemanas)
                    ->with('mesasConMasVentas',$mesasConMasVentas)
                    ->with('flag', $flag)
                    ->with('notificaciones',$notificaciones)
                    ->with('nuevas',$nuevas)
                    ->with('fecha2array',$fecha2array)
                    ->with('tutorial',$userActual->estadoTut)
                    ->with('utilidadHoy',$utilidadHoy)
                    ->with('nMesasReservadas',$nMesasReservadas)
                    ->with('flujoPersonas',$flujoPersonas)
                    ->with('mesas',json_encode($mesaArray))
                    ->with('vendedores', json_encode($vendedorArray));
        } else {
            $flag = true;
            //ESTADISTICAS DEL DÍA 
            //Utilidad 
            $utilidadHoy = 0;
            $facturasHoy = Factura::listarFacturaDia(Auth::user()->empresaActual)->get();
            for ($i=0; $i < sizeof($facturasHoy); $i++) { 
                $ventas = Venta::listarElementosId($facturasHoy[$i]->id)->get();
                for ($j=0; $j < sizeof($ventas); $j++) { 
                    $contiene = Contiene::idProducto($ventas[$j]->idProducto)->get();
                    for ($k=0; $k < sizeof($contiene); $k++) { 
                        $insumo = Insumo::find($contiene[$k]->idInsumo);
                        $utilidad = 0;
                        if($insumo->esProducto){
                            $utilidad = $insumo->valorCompra - $insumo->precioUnidad;
                            $utilidadHoy = $utilidadHoy + $utilidad;
                        }else{//validación si es bar o restaurante falta
                            $producto = Producto::find($contiene[$k]->idProducto);
                            $costoXonza = ($contiene[$k]->cantidad)/$insumo->valorCompra;
                            $ventaXonza = ($contiene[$k]->cantidad)/$insumo->precioUnidad;
                            $utilidad = $producto->precio - ($contiene[$k]->cantidad)/$insumo->valorCompra;
                            $utilidadHoy = $utilidadHoy + $utilidad;
                        }
                    }
                }
            }   
            //Ventas por vendedor
            $vendedores = array();
            $vendedorArray[] = ['Nombre', 'Total venta'];
            $meserosAux = User::searchUsers(Auth::user()->empresaActual)->get();
            for ($i=0; $i < sizeof($facturasHoy); $i++) {
                $facturAux = Factura::find($facturasHoy[$i]->id);
                $boolean = 0;
                for ($j=0; $j < sizeof($vendedores); $j++) { 
                    if($vendedores[$j][0] == $facturAux->idUsuario){
                        $vendedores[$j][2] = $vendedores[$j][2] + $facturAux->total;
                        $boolean = 1;
                    }
                }
                if($boolean == 0){
                    for ($j=0; $j < sizeof($meserosAux) ; $j++) { 
                        if($meserosAux[$j]->id == $facturAux->idUsuario){
                            //dd($meserosAux[$j]->id);
                            array_push($vendedores, array($meserosAux[$j]->id, $meserosAux[$j]->nombrePersona, $facturAux->total)); 
                            //dd($vendedores);
                        }
                    }
                }
            }
            for ($i=0; $i < sizeof($vendedores); $i++) { 
                $vendedorArray[$i+1] = [$vendedores[$i][1], $vendedores[$i][2]];
            }
            //Mesas reservadas si hay
            $mesasReservadas = Mesa::mesasReservadas(Auth::user()->empresaActual)->get();
            $nMesasReservadas = sizeof($mesasReservadas);
            //Personal trabajando hoy

            //Flujo de personas
            $flujoPersonas = 0;
            for ($i=0; $i < sizeof($facturasHoy); $i++) { 
                $facturAux = Factura::find($facturasHoy[$i]->id);
                $flujoPersonas = $flujoPersonas + $facturAux->nPersonas;
            }

            //Mesa que más vende
            $mesasMayores = array(); // Retorna la mesa que más vende
            $mesaArray[] = ['Nombre','Total venta'];
            $mesasAux = Mesa::mesasAdmin(Auth::user()->empresaActual)->get();
            for ($i=0; $i < sizeof($facturasHoy); $i++) {
                $facturAux = Factura::find($facturasHoy[$i]->id);
                $boolean = 0;
                for ($j=0; $j < sizeof($mesasMayores); $j++) { 
                    if($mesasMayores[$j][0] == $facturAux->idMesa){
                        $mesasMayores[$j][2] = $mesasMayores[$j][2] + $facturAux->total;
                        $boolean = 1;
                    }
                }
                if($boolean == 0){
                    for ($j=0; $j < sizeof($mesasAux) ; $j++) { 
                        if($mesasAux[$j]->id == $facturAux->idMesa){
                            array_push($mesasMayores, array($mesasAux[$j]->id, $mesasAux[$j]->nombreMesa, $facturAux->total)); 
                        }
                    }
                }
            }

            function mesaSorting($a, $b){
                $t1 = $a['1'];
                $t2 = $b['1'];
                if($t1 > $t2) return 1;
                else return 0;
            }
            usort($mesasMayores, function($a, $b){
                $t1 = $a['1'];
                $t2 = $b['1'];
                if($t1 < $t2) return 1;
                else return 0;
            });

            for ($i=0; $i < sizeof($mesasMayores); $i++) { 
                $mesaArray[$i+1] = [$mesasMayores[$i][1], $mesasMayores[$i][2]];
            }
            //FIN ESTADISTICAS DEL DÍA
            return View('WelcomeAdmin/welcome')
                ->with('flag', $flag)
                ->with('notificaciones',$notificaciones)
                ->with('nuevas',$nuevas)
                ->with('fecha2array',$fecha2array)
                ->with('tutorial',$userActual->estadoTut)
                ->with('utilidadHoy',$utilidadHoy)
                ->with('utilidadHoy',$utilidadHoy)
                ->with('nMesasReservadas',$nMesasReservadas)
                ->with('flujoPersonas',$flujoPersonas)
                ->with('mesas',json_encode($mesaArray))
                ->with('vendedores', json_encode($vendedorArray))
                ->with('vendedores', json_encode($vendedorArray));
        }
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

    public function ventaCadaDiaSemana(){
        $carbon = new \Carbon\Carbon();
        $fechaHoy = $carbon->today();
        $ventaSemanaActual  = Factura::ventaCadaDiaSemana(Auth::user()->empresaActual,$fechaHoy)->get()->toArray();
        $ventaSemanaAnterior = Factura::ventaCadaDiaSemana(Auth::user()->empresaActual,$fechaHoy->subWeek(1))->get()->toArray();
        $dias = ['Monday', 'Tuesday', 'Wednesday', 'Thursday','Friday','Saturday','Sunday'];
        $arrayVentaSemanaActual = array();
        $arrayVentaSemanaAnterior = array();
        $it1 = $it2 = 0;
        //dd($ventaSemanaActual[1]);
        foreach ($dias as $key => $value) {
            if(current($ventaSemanaActual)['dia'] == $value){
                array_push($arrayVentaSemanaActual, current($ventaSemanaActual)['totalVentas']);
                next($ventaSemanaActual);
            }else{
                array_push($arrayVentaSemanaActual, 0);
            }
            if(current($ventaSemanaAnterior)['dia'] == $value){
                array_push($arrayVentaSemanaAnterior, current($ventaSemanaAnterior)['totalVentas']);
                next($ventaSemanaAnterior);
            }else{
                array_push($arrayVentaSemanaAnterior,0);
            }    
        }
        $datosSemanas=  [$arrayVentaSemanaActual,$arrayVentaSemanaAnterior];       
        return $datosSemanas;
    }

    public function VentasSemana(){
        $carbon = new \Carbon\Carbon();
        $fechaHoy = $carbon->today();
        $ventaSemanaActual  = floatval(Factura::ventaSemana(Auth::user()->empresaActual,$fechaHoy)->first()->totalVentas);
        $cantidadVentasSemanaActual = floatval(Factura::cantidadVentasSemana(Auth::user()->empresaActual,$fechaHoy)->first()->cantidadVentas);
        $ventaSemanaAnterior  = floatval(Factura::ventaSemana(Auth::user()->empresaActual,$fechaHoy->subWeek(1))->first()->totalVentas);
        $cantidadVentasSemanaAnterior = floatval(Factura::cantidadVentasSemana(Auth::user()->empresaActual,$fechaHoy)->first()->cantidadVentas);

        if (($ventaSemanaAnterior == 0) && ($ventaSemanaActual != 0 )) {
            $porcentajeVentas = 100;
        } elseif(($ventaSemanaAnterior == 0) && ($ventaSemanaActual == 0 )){
            $porcentajeVentas = 0;
        } else {
            $porcentajeVentas = ($ventaSemanaActual*100)/($ventaSemanaAnterior)-100;
        }

        if (($cantidadVentasSemanaAnterior == 0) && ($cantidadVentasSemanaActual != 0 )) {
            $porcentajeCantidadVentas = 100;
        } elseif(($cantidadVentasSemanaAnterior == 0) && ($cantidadVentasSemanaActual == 0 )){
            $porcentajeCantidadVentas = 0;
        } else {
            $porcentajeCantidadVentas = ($cantidadVentasSemanaActual*100)/($cantidadVentasSemanaAnterior)-100;
        }

        return array( 'ventaSemanaActual' => $ventaSemanaActual,
                      'cantidadVentasSemanaActual' => $cantidadVentasSemanaActual,
                      'ventaSemanaAnterior' => $ventaSemanaAnterior,
                      'cantidadVentasSemanaAnterior' => $cantidadVentasSemanaAnterior,
                      'porcentajeVentas'=> $porcentajeVentas,
                      'porcentajeCantidadVentas'=> $porcentajeCantidadVentas);

    }

    public function cantidadVentasDelDia(){ //Cantidad de ventas que se han hecho en el día
        $carbon = new \Carbon\Carbon();
        $fechaHoy = $carbon->today()->toDateString();
        $venta = Factura::CantidadVentasDelDia(Auth::user()->empresaActual,$fechaHoy)->first();
        return $venta->cantidadVentas;
    }

    public function ventaDelDia(){
        $carbon = new \Carbon\Carbon();
        $fechaHoy = $carbon->today()->toDateString();
        $venta = Factura::ventaDelDia(Auth::user()->empresaActual,$fechaHoy)->first();
        return $venta->totalVentas;
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
