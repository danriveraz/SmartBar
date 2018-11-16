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
use PocketByR\Empresa;
use PocketByR\Proveedor;

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
        $empresa = Empresa::find(Auth::user()->empresaActual)->first();
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
                    ->with('empresa',$empresa)
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
                ->with('empresa',$empresa)
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

    public function datos(Request $request){
        $userActual = Auth::user();
        $userActual->estadoTut = 1;
        $userActual->save();
        $empresa = Empresa::find($userActual->empresaActual);
        $empresa->nombreEstablecimiento = $request->negocio;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->baroRestaurante = $request->TipoNegocio;
        $empresa->nit = $request->nit;
        $empresa->tipoRegimen = $request->tipReg;

        if($request->tipReg == "RegComun") {
            $empresa->imagenResolucionFacturacion = $request->imgRes;
            $empresa->nresolucionFacturacion = $request->resolucion;
            $empresa->fechaResolucion = $request->fechaResolucion;
            $empresa->nInicio = $request->nInicio;
            $empresa->nFinal = $request->nFinal;
        }
        $empresa->save();

        $cantidadActualMesas = Mesa::calculaCantidad($userActual->idEmpresa);
        if(!is_int($cantidadActualMesas)) $cantidadActualMesas = 0;
        for ($i=0; $i < $request->mesas; $i++) {
            $cantidadActualMesas++;
            $mesa = new Mesa;
            $mesa->idMesa = $cantidadActualMesas;
            $mesa->nombreMesa = "Mesa $cantidadActualMesas";
            $mesa->estado = "Disponible";
            $mesa->idEmpresa = $userActual->idEmpresa;
            $mesa->save();
        }

        //Inicio carga predeterminada

            //CATEGORIAS GENERALES
            $categoria1 = new Categoria;
            $categoria1->nombre = "Bebidas";
            $categoria1->idEmpresa = $empresa->id;
            $categoria1->imagen = "bebidas.png";
            $categoria1->save();

            $categoria2 = new Categoria;
            $categoria2->nombre = "Postres";
            $categoria2->idEmpresa = $empresa->id;
            $categoria2->imagen = "postres.png";
            $categoria2->save();

            $categoria3 = new Categoria;
            $categoria3->nombre = "Adiciones";
            $categoria3->idEmpresa = $empresa->id;
            $categoria3->imagen = "adiciones.png";
            $categoria3->save();

            $categoria4 = new Categoria;
            $categoria4->nombre = "Especiales";
            $categoria4->idEmpresa = $empresa->id;
            $categoria4->imagen = "especiales.png";
            $categoria4->save();

            $categoria5 = new Categoria;
            $categoria5->nombre = "Otros";
            $categoria5->idEmpresa = $empresa->id;
            $categoria5->imagen = "otros.png";
            $categoria5->save();

        //PROVEEDOR GENERAL
            $proveedor = new Proveedor;
            $proveedor->nombre = "Desconocido";
            $proveedor->idEmpresa = $empresa->id;
            $proveedor->save();

        if($empresa->baroRestaurante == "bar" || $empresa->baroRestaurante == "barRestaurante"){
                //CATEGORIAS BAR
                $categoria6 = new Categoria;
                $categoria6->nombre = "Cervezas";
                $categoria6->idEmpresa = $empresa->id;
                $categoria6->imagen = "cervezas.png";
                $categoria6->save();

                $categoria7 = new Categoria;
                $categoria7->nombre = "Licores";
                $categoria7->idEmpresa = $empresa->id;
                $categoria7->imagen = "licores.png";
                $categoria7->save();

                $categoria8 = new Categoria;
                $categoria8->nombre = "Cocteles";
                $categoria8->idEmpresa = $empresa->id;
                $categoria8->imagen = "cocteles.png";
                $categoria8->save();

                $categoria9 = new Categoria;
                $categoria9->nombre = "Shots";
                $categoria9->idEmpresa = $empresa->id;
                $categoria9->imagen = "shots.png";
                $categoria9->save();

                $categoria10 = new Categoria;
                $categoria10->nombre = "Sin licor";
                $categoria10->idEmpresa = $empresa->id;
                $categoria10->imagen = "sinLicor.png";
                $categoria10->save();

                //INSUMOS BAR
                $insumo1 = new Insumo;
                $insumo1->idProveedor = $proveedor->id;
                $insumo1->nombre = "Brandy";
                $insumo1->medida = 0;
                $insumo1->idEmpresa = $empresa->id;
                $insumo1->save();

                $insumo2 = new Insumo;
                $insumo2->idProveedor = $proveedor->id;
                $insumo2->nombre = "Crema de Cacao";
                $insumo2->medida = 0;
                $insumo2->idEmpresa = $empresa->id;
                $insumo2->save();

                $insumo3 = new Insumo;
                $insumo3->idProveedor = $proveedor->id;
                $insumo3->nombre = "Nata líquida";
                $insumo3->medida = 0;
                $insumo3->idEmpresa = $empresa->id;
                $insumo3->save();

                $insumo4 = new Insumo;
                $insumo4->idProveedor = $proveedor->id;
                $insumo4->nombre = "Licor de café (Kahlua)";
                $insumo4->medida = 0;
                $insumo4->idEmpresa = $empresa->id;
                $insumo4->save();

                $insumo5 = new Insumo;
                $insumo5->idProveedor = $proveedor->id;
                $insumo5->nombre = "Crema de Whiskey";
                $insumo5->medida = 0;
                $insumo5->idEmpresa = $empresa->id;
                $insumo5->save();

                $insumo6 = new Insumo;
                $insumo6->idProveedor = $proveedor->id;
                $insumo6->nombre = "Grand Marnier";
                $insumo6->medida = 0;
                $insumo6->idEmpresa = $empresa->id;
                $insumo6->save();

                $insumo7 = new Insumo;
                $insumo7->idProveedor = $proveedor->id;
                $insumo7->nombre = "Ron blanco Bacardi";
                $insumo7->medida = 0;
                $insumo7->idEmpresa = $empresa->id;
                $insumo7->save();

                $insumo8 = new Insumo;
                $insumo8->idProveedor = $proveedor->id;
                $insumo8->nombre = "Jugo de lima";
                $insumo8->medida = 0;
                $insumo8->idEmpresa = $empresa->id;
                $insumo8->save();

                $insumo9 = new Insumo;
                $insumo9->idProveedor = $proveedor->id;
                $insumo9->nombre = "Granadina";
                $insumo9->medida = 0;
                $insumo9->idEmpresa = $empresa->id;
                $insumo9->save();

                $insumo10 = new Insumo;
                $insumo10->idProveedor = $proveedor->id;
                $insumo10->nombre = "Ron blanco";
                $insumo10->medida = 0;
                $insumo10->idEmpresa = $empresa->id;
                $insumo10->save();

                $insumo11 = new Insumo;
                $insumo11->idProveedor = $proveedor->id;
                $insumo11->nombre = "Coñac";
                $insumo11->medida = 0;
                $insumo11->idEmpresa = $empresa->id;
                $insumo11->save();

                $insumo12 = new Insumo;
                $insumo12->idProveedor = $proveedor->id;
                $insumo12->nombre = "Triple seco";
                $insumo12->medida = 0;
                $insumo12->idEmpresa = $empresa->id;
                $insumo12->save();

                $insumo13 = new Insumo;
                $insumo13->idProveedor = $proveedor->id;
                $insumo13->nombre = "Zumo de limón";
                $insumo13->medida = 0;
                $insumo13->idEmpresa = $empresa->id;
                $insumo13->save();

                $insumo14 = new Insumo;
                $insumo14->idProveedor = $proveedor->id;
                $insumo14->nombre = "Vodka";
                $insumo14->medida = 0;
                $insumo14->idEmpresa = $empresa->id;
                $insumo14->save();

                $insumo15 = new Insumo;
                $insumo15->idProveedor = $proveedor->id;
                $insumo15->nombre = "Cachaça";
                $insumo15->medida = 0;
                $insumo15->idEmpresa = $empresa->id;
                $insumo15->save();

                $insumo16 = new Insumo;
                $insumo16->idProveedor = $proveedor->id;
                $insumo16->nombre = "Old Tom Gin";
                $insumo16->medida = 0;
                $insumo16->idEmpresa = $empresa->id;
                $insumo16->save();

                $insumo17 = new Insumo;
                $insumo17->idProveedor = $proveedor->id;
                $insumo17->nombre = "Maraschino";
                $insumo17->medida = 0;
                $insumo17->idEmpresa = $empresa->id;
                $insumo17->save();

                $insumo18 = new Insumo;
                $insumo18->idProveedor = $proveedor->id;
                $insumo18->nombre = "Amargo naranja";
                $insumo18->medida = 0;
                $insumo18->idEmpresa = $empresa->id;
                $insumo18->save();

                $insumo19 = new Insumo;
                $insumo19->idProveedor = $proveedor->id;
                $insumo19->nombre = "Jugo de limón";
                $insumo19->medida = 0;
                $insumo19->idEmpresa = $empresa->id;
                $insumo19->save();

                $insumo20 = new Insumo;
                $insumo20->idProveedor = $proveedor->id;
                $insumo20->nombre = "Vodka limón";
                $insumo20->medida = 0;
                $insumo20->idEmpresa = $empresa->id;
                $insumo20->save();

                $insumo21 = new Insumo;
                $insumo21->idProveedor = $proveedor->id;
                $insumo21->nombre = "Cointreau";
                $insumo21->medida = 0;
                $insumo21->idEmpresa = $empresa->id;
                $insumo21->save();

                $insumo22 = new Insumo;
                $insumo22->idProveedor = $proveedor->id;
                $insumo22->nombre = "Zumo de arándano";
                $insumo22->medida = 0;
                $insumo22->idEmpresa = $empresa->id;
                $insumo22->save();

                $insumo23 = new Insumo;
                $insumo23->idProveedor = $proveedor->id;
                $insumo23->nombre = "Cola";
                $insumo23->medida = 0;
                $insumo23->idEmpresa = $empresa->id;
                $insumo23->save();

                $insumo24 = new Insumo;
                $insumo24->idProveedor = $proveedor->id;
                $insumo24->nombre = "Zumo de lima";
                $insumo24->medida = 0;
                $insumo24->idEmpresa = $empresa->id;
                $insumo24->save();

                $insumo25 = new Insumo;
                $insumo25->idProveedor = $proveedor->id;
                $insumo25->nombre = "Jarabe de frutas (fresa, plátano, piña, etc.)";
                $insumo25->medida = 0;
                $insumo25->idEmpresa = $empresa->id;
                $insumo25->save();

                $insumo26 = new Insumo;
                $insumo26->idProveedor = $proveedor->id;
                $insumo26->nombre = "Ginebra";
                $insumo26->medida = 0;
                $insumo26->idEmpresa = $empresa->id;
                $insumo26->save();

                $insumo27 = new Insumo;
                $insumo27->idProveedor = $proveedor->id;
                $insumo27->nombre = "Vermut seco";
                $insumo27->medida = 0;
                $insumo27->idEmpresa = $empresa->id;
                $insumo27->save();

                $insumo28 = new Insumo;
                $insumo28->idProveedor = $proveedor->id;
                $insumo28->nombre = "Scotch Whiskey";
                $insumo28->medida = 0;
                $insumo28->idEmpresa = $empresa->id;
                $insumo28->save();

                $insumo29 = new Insumo;
                $insumo29->idProveedor = $proveedor->id;
                $insumo29->nombre = "Amaretto";
                $insumo29->medida = 0;
                $insumo29->idEmpresa = $empresa->id;
                $insumo29->save();

                $insumo30 = new Insumo;
                $insumo30->idProveedor = $proveedor->id;
                $insumo30->nombre = "Zumo de naranja";
                $insumo30->medida = 0;
                $insumo30->idEmpresa = $empresa->id;
                $insumo30->save();

                $insumo31 = new Insumo;
                $insumo31->idProveedor = $proveedor->id;
                $insumo31->nombre = "Sirope";
                $insumo31->medida = 0;
                $insumo31->idEmpresa = $empresa->id;
                $insumo31->save();

                $insumo32 = new Insumo;
                $insumo32->idProveedor = $proveedor->id;
                $insumo32->nombre = "Tequila";
                $insumo32->medida = 0;
                $insumo32->idEmpresa = $empresa->id;
                $insumo32->save();

                $insumo33 = new Insumo;
                $insumo33->idProveedor = $proveedor->id;
                $insumo33->nombre = "Ron oscuro añejo";
                $insumo33->medida = 0;
                $insumo33->idEmpresa = $empresa->id;
                $insumo33->save();

                $insumo34 = new Insumo;
                $insumo34->idProveedor = $proveedor->id;
                $insumo34->nombre = "Curacao de naranja";
                $insumo34->medida = 0;
                $insumo34->idEmpresa = $empresa->id;
                $insumo34->save();

                $insumo35 = new Insumo;
                $insumo35->idProveedor = $proveedor->id;
                $insumo35->nombre = "Whiskey";
                $insumo35->medida = 0;
                $insumo35->idEmpresa = $empresa->id;
                $insumo35->save();

                $insumo36 = new Insumo;
                $insumo36->idProveedor = $proveedor->id;
                $insumo36->nombre = "Vermut Rojo";
                $insumo36->medida = 0;
                $insumo36->idEmpresa = $empresa->id;
                $insumo36->save();

                $insumo37 = new Insumo;
                $insumo37->idProveedor = $proveedor->id;
                $insumo37->nombre = "Menta";
                $insumo37->medida = 1;
                $insumo37->idEmpresa = $empresa->id;
                $insumo37->save();

                $insumo38 = new Insumo;
                $insumo38->idProveedor = $proveedor->id;
                $insumo38->nombre = "Campari";
                $insumo38->medida = 0;
                $insumo38->idEmpresa = $empresa->id;
                $insumo38->save();

                $insumo39 = new Insumo;
                $insumo39->idProveedor = $proveedor->id;
                $insumo39->nombre = "Jugo de naranja";
                $insumo39->medida = 0;
                $insumo39->idEmpresa = $empresa->id;
                $insumo39->save();

                $insumo40 = new Insumo;
                $insumo40->idProveedor = $proveedor->id;
                $insumo40->nombre = "Jugo de piña";
                $insumo40->medida = 0;
                $insumo40->idEmpresa = $empresa->id;
                $insumo40->save();

                $insumo41 = new Insumo;
                $insumo41->idProveedor = $proveedor->id;
                $insumo41->nombre = "Leche de coco";
                $insumo41->medida = 0;
                $insumo41->idEmpresa = $empresa->id;
                $insumo41->save();

                $insumo42 = new Insumo;
                $insumo42->idProveedor = $proveedor->id;
                $insumo42->nombre = "Aguardiente de melocotón";
                $insumo42->medida = 0;
                $insumo42->idEmpresa = $empresa->id;
                $insumo42->save();

                $insumo43 = new Insumo;
                $insumo43->idProveedor = $proveedor->id;
                $insumo43->nombre = "Jugo de arándanos";
                $insumo43->medida = 0;
                $insumo43->idEmpresa = $empresa->id;
                $insumo43->save();

                $insumo44 = new Insumo;
                $insumo44->idProveedor = $proveedor->id;
                $insumo44->nombre = "Ron";
                $insumo44->medida = 0;
                $insumo44->idEmpresa = $empresa->id;
                $insumo44->save();

                $insumo45 = new Insumo;
                $insumo45->idProveedor = $proveedor->id;
                $insumo45->nombre = "Curacao azul";
                $insumo45->medida = 0;
                $insumo45->idEmpresa = $empresa->id;
                $insumo45->save();

                //PRODUCTOS BAR
                $producto1 = new Producto;
                $producto1->nombre = "Alexander";
                $producto1->descripcion = "Cóctel digestivo por las propiedades digestivas del coñac o brandy";
                $producto1->receta = "Verter el hielo, el Brandy, la crema de cacao y la nata liquida en la coctelera y agitar muy bien, colar en la copa, decorar con una fresa y espolvorear canela o una pizca de nuez moscada.";
                $producto1->imagen = "Alexander.png";
                $producto1->idCategoria = $categoria5->id;
                $producto1->idEmpresa = $empresa->id;
                $producto1->save();

                $producto2 = new Producto;
                $producto2->nombre = "B52";
                $producto2->descripcion = "Es un cóctel más bien digestivo";
                $producto2->receta = "Las capas se forman por densidad y orden con los ingredientes Kahlua, seguido de Bailey’s y en la superficie con Grand Marnier o Ginebra. Después se flambea el Grand Marnier o el Ginebra de la superficie y se sirve con la llama aún encendida, para una mejor dicion de los colores se puede aplicar con una cuchara, para suavizar la aplicación. Puede tomarse con pitillo, tomando un poco de cada sabor.";
                $producto2->imagen = "B52.png";
                $producto2->idCategoria = $categoria5->id;
                $producto2->idEmpresa = $empresa->id;
                $producto2->save();

                $producto3 = new Producto;
                $producto3->nombre = "Bacardi Red";
                $producto3->descripcion = "Cóctel de aperitivo";
                $producto3->receta = "Verter todos los ingredientes en la coctelera y agitar muy bien. Colar en la copa. Decorar con una rodaja de limón y una fresa atravesadas por un palillo de plástico o rodear la copa con sal y decorar con una fresa o cereza. Se puede reemplazar el jugo de lima con jugo de limón.";
                $producto3->imagen = "Bacardi Red.png";
                $producto3->idCategoria = $categoria5->id;
                $producto3->idEmpresa = $empresa->id;
                $producto3->save();

                $producto4 = new Producto;
                $producto4->nombre = "Between the Sheets";
                $producto4->descripcion = "Cóctel para tomar durante todo el día.";
                $producto4->receta = "Verter todos los ingredientes en la coctelera con hielos, agitar y colar en un vaso frío de coctel. Se puede reemplazar el coñac con brandy.";

                $producto4->imagen = "Between the Sheets.png";
                $producto4->idCategoria = $categoria5->id;
                $producto4->idEmpresa = $empresa->id;
                $producto4->save();

                $producto5 = new Producto;
                $producto5->nombre = "Black Russian/White Russian";
                $producto5->descripcion = "Cóctel digestivo";
                $producto5->receta = "Echar los ingredientes en un vaso ancho con hielos, y revolver suavemente. Para hacer el White Russian, hacer flotar nata fresca por la superficie y revolver.";

                $producto5->imagen = "Black Russian.png";
                $producto5->idCategoria = $categoria5->id;
                $producto5->idEmpresa = $empresa->id;
                $producto5->save();

                $producto6 = new Producto;
                $producto6->nombre = "Caipirinha/Caipiroska";
                $producto6->descripcion = "Destinado para beber a cualquier hora del día";
                $producto6->receta = "Poner media lima fresca cortada en 4 trozos y azúcar en un vaso ancho y mezclarlo, llenar el vaso con hielo y Cachaça, si queremos una Caipiroska, cambiamos la Cachaca por Vodka.";
                $producto6->imagen = "Caipirinha.png";
                $producto6->idCategoria = $categoria5->id;
                $producto6->idEmpresa = $empresa->id;
                $producto6->save();

                $producto7 = new Producto;
                $producto7->nombre = "Casino";
                $producto7->descripcion = "Cóctel para disfrutar a cualquier hora del día";
                $producto7->receta = "Mezclar todos los ingredientes en una coctelera con hielos, agitar bien, colar en un vaso de coctel frío y decorar con una cereza y rodear la copa con sal.";
                $producto7->imagen = "Casino.png";
                $producto7->idCategoria = $categoria5->id;
                $producto7->idEmpresa = $empresa->id;
                $producto7->save();

                $producto8 = new Producto;
                $producto8->nombre = "Cosmopolitan";
                $producto8->descripcion = "Para cualquier hora del día";
                $producto8->receta = "Agitar todos los elementos con hielo en una coctelera. Servir en un vaso largo de coctel. Decorar con una rodaja de limón y una cereza. Se puede reemplazar el jugo de lima con jugo de limón.";
                $producto8->imagen = "Cosmopolitan.png";
                $producto8->idCategoria = $categoria5->id;
                $producto8->idEmpresa = $empresa->id;
                $producto8->save();

                $producto9 = new Producto;
                $producto9->nombre = "Cubalibre";
                $producto9->receta = "Mezclar todos los ingredientes en un vaso largo lleno de hielo y decorar con una porción de limón.";
                $producto9->imagen = "Cubalibre.png";
                $producto9->idCategoria = $categoria5->id;
                $producto9->idEmpresa = $empresa->id;
                $producto9->save();

                $producto10 = new Producto;
                $producto10->nombre = "Daiquiri";
                $producto10->descripcion = "Cóctel de aperitivo";
                $producto10->receta = "Licuar todos los ingredientes junto con el hielo, revolver y colar en un vaso de coctel.";
                $producto10->imagen = "Daiquiri.png";
                $producto10->idCategoria = $categoria5->id;
                $producto10->idEmpresa = $empresa->id;
                $producto10->save();

                $producto11 = new Producto;
                $producto11->nombre = "Dry Martini sucio";
                $producto11->descripcion = "Cóctel digestivo";
                $producto11->receta = "Echar todos los ingredientes en un vaso mezclador con hielos, remover bien y colar en un vaso frío de Martini. Exprimir el aceite de la corteza de limón en la bebida y decorar con aceitunas, Recomendación: poner siempre aceitunas impares, una, tres o cinco. Para hacer un Dry Martini limpio, bañar la copa con vermut y eliminarlo, agregar el ginebra.";
                $producto11->imagen = "Dry Martini sucio.png";
                $producto11->idCategoria = $categoria5->id;
                $producto11->idEmpresa = $empresa->id;
                $producto11->save();

                $producto12 = new Producto;
                $producto12->nombre = "God Father/God Mother";
                $producto12->descripcion = "Cóctel digestivo";
                $producto12->receta = "Verter directamente todos los ingredientes en un vaso ancho lleno de hielos y remover suavemente. Con vodka en vez de whisky, se llama God Mother.";
                $producto12->imagen = "God Father.png";
                $producto12->idCategoria = $categoria5->id;
                $producto12->idEmpresa = $empresa->id;
                $producto12->save();

                $producto13 = new Producto;
                $producto13->nombre = "Long Island Ice Tea";
                $producto13->receta = "Añadir todos los ingredientes en un vaso largo lleno de hielo, revolver y decorar con rodaja de limón. Adicionar un toque de té o coca cola";
                $producto13->imagen = "Long Island Ice Tea.png";
                $producto13->idCategoria = $categoria5->id;
                $producto13->idEmpresa = $empresa->id;
                $producto13->save();

                $producto14 = new Producto;
                $producto14->nombre = "Mai-Tai";
                $producto14->receta = "Agitar en un vaso largo, y decorar con una porción de piña, hojas de menta o piel de lima. Servir con pitillo y mezclador. Se puede reemplazar el Curacao de naranja por Cointreau.";
                $producto14->imagen = "Mai-Tai.png";
                $producto14->idCategoria = $categoria5->id;
                $producto14->idEmpresa = $empresa->id;
                $producto14->save();

                $producto15 = new Producto;
                $producto15->nombre = "Manhattan";
                $producto15->descripcion = "Coctel de aperitivo por su amargo que abre el apetito";
                $producto15->receta = "Echar todos los ingredientes en un mezclador con hielos, agregando un toque de amargo de Angostura y remover bien. Colarlo en un vaso de coctel enfriado y decorarlo con cereza.";
                $producto15->imagen = "Manhattan.png";
                $producto15->idCategoria = $categoria5->id;
                $producto15->idEmpresa = $empresa->id;
                $producto15->save();

                $producto16 = new Producto;
                $producto16->nombre = "Margarita";
                $producto16->descripcion = "Para beber a cualquier hora del día";
                $producto16->receta = "Echar todos los ingredientes en una coctelera con hielo, agitarlo bien y colarlo en un vaso de coctel bordeado con sal. Jugo de limón recién exprimido.";
                $producto16->imagen = "Margarita.png";
                $producto16->idCategoria = $categoria5->id;
                $producto16->idEmpresa = $empresa->id;
                $producto16->save();

                $producto17 = new Producto;
                $producto17->nombre = "Mojito";
                $producto17->receta = "Machacar las ramas de menta o hierbabuena con dos cucharillas azúcar y jugo de lima. Añadir un chorro de soda, agua con gas o ginger y llenar el vaso con hielo molido. Echar ron y llenarlo con la soda, agua con gas o ginger de nuevo. Decorar con hojas de menta y una rodaja de limón, servir con pitillo.";
                $producto17->imagen = "Mojito.png";
                $producto17->idCategoria = $categoria5->id;
                $producto17->idEmpresa = $empresa->id;
                $producto17->save();

                $producto18 = new Producto;
                $producto18->nombre = "Negroni";
                $producto18->descripcion = "Coctel de aperitivo debido a que el amargo del Campari abre el apetito";
                $producto18->receta = "Echar todos los ingredientes en un vaso ancho lleno de hielo y remover suavemente. Adornar con media rodaja de naranja.";
                $producto18->imagen = "Negroni.png";
                $producto18->idCategoria = $categoria5->id;
                $producto18->idEmpresa = $empresa->id;
                $producto18->save();

                $producto19 = new Producto;
                $producto19->nombre = "Old Fashioned";
                $producto19->descripcion = "Coctel de aperitivo por su amargo Angostura";
                $producto19->receta = "Poner un terrón de azúcar en un vaso ancho y empaparlo de amargo (dos pizcas), añadir soda y remover hasta disolverlo. Llenar el vaso con hielo y añadir whisky. Decorar con una rodaja de naranja y una cereza.";
                $producto19->imagen = "Old Fashioned.png";
                $producto19->idCategoria = $categoria5->id;
                $producto19->idEmpresa = $empresa->id;
                $producto19->save();

                $producto20 = new Producto;
                $producto20->nombre = "Paradise";
                $producto20->descripcion = "Para tomar a cualquier hora";
                $producto20->receta = "Verter todos los ingredientes en una coctelera llena de hielo, agitar y colar en vaso de frío de coctel.";
                $producto20->imagen = "Paradise.png";
                $producto20->idCategoria = $categoria5->id;
                $producto20->idEmpresa = $empresa->id;
                $producto20->save();

                $producto21 = new Producto;
                $producto21->nombre = "Piña Colada";
                $producto21->receta = "Mezclar todos los ingredientes con hielo en una licuadora, echar en una copa grande, en un vaso tipo Hurricane o en una piña, y servir con pajita. Se suele adornar con una rodaja de piña y con una cereza de coctel.";
                $producto21->imagen = "Piña Colada.png";
                $producto21->idCategoria = $categoria5->id;
                $producto21->idEmpresa = $empresa->id;
                $producto21->save();

                $producto22 = new Producto;
                $producto22->nombre = "Screw Driver/Bulldog";
                $producto22->descripcion = "Para cualquier hora del día";
                $producto22->receta = "Echar todos los ingredientes en un vaso largo lleno de hielo. Remover suavemente y decorarlo con una rodaja de naranja. Si en vez de vodka lleva ginebra (preferiblemente Bulldog, se le llama así).";
                $producto22->imagen = "Screw Driver.png";
                $producto22->idCategoria = $categoria5->id;
                $producto22->idEmpresa = $empresa->id;
                $producto22->save();

                $producto23 = new Producto;
                $producto23->nombre = "Sex on the Beach";
                $producto23->receta = "Verter todos los ingredientes en un vaso largo lleno de hielo. Decorar con una rodaja de naranja y una cereza.";
                $producto23->imagen = "Sex on the Beach.png";
                $producto23->idCategoria = $categoria5->id;
                $producto23->idEmpresa = $empresa->id;
                $producto23->save();

                $producto24 = new Producto;
                $producto24->nombre = "Tequila Sunrise";
                $producto24->receta = "Echar tequila y zumo de naranja directamente en un vaso largo con hielos y rociar un poco de granadina sin remover para crear un efecto cromático. Decorar con una rodaja de naranja y una cereza.";
                $producto24->imagen = "Tequila Sunrise.png";
                $producto24->idCategoria = $categoria5->id;
                $producto24->idEmpresa = $empresa->id;
                $producto24->save();

                $producto25 = new Producto;
                $producto25->nombre = "Blue Hawaii";
                $producto25->receta = "Se mezclan todos los ingredientes en una coctelera con hielo y se agitan bien durante 8 segundos. Adornar la copa con uno naranja o piña y cereza.";
                $producto25->imagen = "Blue Hawaii.png";
                $producto25->idCategoria = $categoria5->id;
                $producto25->idEmpresa = $empresa->id;
                $producto25->save();

                //CONTIENE BAR
                $contiene1 = new Contiene;
                $contiene1->idProducto = $producto1->id;
                $contiene1->idInsumo = $insumo1->id;
                $contiene1->cantidad = 1;
                $contiene1->idEmpresa = $empresa->id;
                $contiene1->save();

                $contiene2 = new Contiene;
                $contiene2->idProducto = $producto1->id;
                $contiene2->idInsumo = $insumo2->id;
                $contiene2->cantidad = 1;
                $contiene2->idEmpresa = $empresa->id;
                $contiene2->save();

                $contiene3 = new Contiene;
                $contiene3->idProducto = $producto1->id;
                $contiene3->idInsumo = $insumo3->id;
                $contiene3->cantidad = 2;
                $contiene3->idEmpresa = $empresa->id;
                $contiene3->save();

                $contiene4 = new Contiene;
                $contiene4->idProducto = $producto2->id;
                $contiene4->idInsumo = $insumo4->id;
                $contiene4->cantidad = 0.68;
                $contiene4->idEmpresa = $empresa->id;
                $contiene4->save();

                $contiene5 = new Contiene;
                $contiene5->idProducto = $producto2->id;
                $contiene5->idInsumo = $insumo5->id;
                $contiene5->cantidad = 0.68;
                $contiene5->idEmpresa = $empresa->id;
                $contiene5->save();

                $contiene6 = new Contiene;
                $contiene6->idProducto = $producto2->id;
                $contiene6->idInsumo = $insumo6->id;
                $contiene6->cantidad = 0.68;
                $contiene6->idEmpresa = $empresa->id;
                $contiene6->save();

                $contiene7 = new Contiene;
                $contiene7->idProducto = $producto3->id;
                $contiene7->idInsumo = $insumo7->id;
                $contiene7->cantidad = 1.5;
                $contiene7->idEmpresa = $empresa->id;
                $contiene7->save();

                $contiene8 = new Contiene;
                $contiene8->idProducto = $producto3->id;
                $contiene8->idInsumo = $insumo8->id;
                $contiene8->cantidad = 0.68;
                $contiene8->idEmpresa = $empresa->id;
                $contiene8->save();

                $contiene9 = new Contiene;
                $contiene9->idProducto = $producto3->id;
                $contiene9->idInsumo = $insumo9->id;
                $contiene9->cantidad = 0.34;
                $contiene9->idEmpresa = $empresa->id;
                $contiene9->save();

                $contiene10 = new Contiene;
                $contiene10->idProducto = $producto4->id;
                $contiene10->idInsumo = $insumo10->id;
                $contiene10->cantidad = 0.34;
                $contiene10->idEmpresa = $empresa->id;
                $contiene10->save();

                $contiene11 = new Contiene;
                $contiene11->idProducto = $producto4->id;
                $contiene11->idInsumo = $insumo11->id;
                $contiene11->cantidad = 0.34;
                $contiene11->idEmpresa = $empresa->id;
                $contiene11->save();

                $contiene12 = new Contiene;
                $contiene12->idProducto = $producto4->id;
                $contiene12->idInsumo = $insumo12->id;
                $contiene12->cantidad = 0.34;
                $contiene12->idEmpresa = $empresa->id;
                $contiene12->save();

                $contiene13 = new Contiene;
                $contiene13->idProducto = $producto4->id;
                $contiene13->idInsumo = $insumo13->id;
                $contiene13->cantidad = 0.34;
                $contiene13->idEmpresa = $empresa->id;
                $contiene13->save();

                $contiene14 = new Contiene;
                $contiene14->idProducto = $producto5->id;
                $contiene14->idInsumo = $insumo14->id;
                $contiene14->cantidad = 1.7;
                $contiene14->idEmpresa = $empresa->id;
                $contiene14->save();

                $contiene15 = new Contiene;
                $contiene15->idProducto = $producto5->id;
                $contiene15->idInsumo = $insumo4->id;
                $contiene15->cantidad = 0.68;
                $contiene15->idEmpresa = $empresa->id;
                $contiene15->save();

                $contiene16 = new Contiene;
                $contiene16->idProducto = $producto6->id;
                $contiene16->idInsumo = $insumo15->id;
                $contiene16->cantidad = 1.7;
                $contiene16->idEmpresa = $empresa->id;
                $contiene16->save();

                $contiene17 = new Contiene;
                $contiene17->idProducto = $producto7->id;
                $contiene17->idInsumo = $insumo16->id;
                $contiene17->cantidad = 1.35;
                $contiene17->idEmpresa = $empresa->id;
                $contiene17->save();

                $contiene18 = new Contiene;
                $contiene18->idProducto = $producto7->id;
                $contiene18->idInsumo = $insumo17->id;
                $contiene18->cantidad = 0.38;
                $contiene18->idEmpresa = $empresa->id;
                $contiene18->save();

                $contiene19 = new Contiene;
                $contiene19->idProducto = $producto7->id;
                $contiene19->idInsumo = $insumo18->id;
                $contiene19->cantidad = 0.38;
                $contiene19->idEmpresa = $empresa->id;
                $contiene19->save();

                $contiene20 = new Contiene;
                $contiene20->idProducto = $producto7->id;
                $contiene20->idInsumo = $insumo19->id;
                $contiene20->cantidad = 0.38;
                $contiene20->idEmpresa = $empresa->id;
                $contiene20->save();

                $contiene21 = new Contiene;
                $contiene21->idProducto = $producto8->id;
                $contiene21->idInsumo = $insumo20->id;
                $contiene21->cantidad = 1.35;
                $contiene21->idEmpresa = $empresa->id;
                $contiene21->save();

                $contiene22 = new Contiene;
                $contiene22->idProducto = $producto8->id;
                $contiene22->idInsumo = $insumo21->id;
                $contiene22->cantidad = 0.5;
                $contiene22->idEmpresa = $empresa->id;
                $contiene22->save();

                $contiene23 = new Contiene;
                $contiene23->idProducto = $producto8->id;
                $contiene23->idInsumo = $insumo8->id;
                $contiene23->cantidad = 0.5;
                $contiene23->idEmpresa = $empresa->id;
                $contiene23->save();

                $contiene24 = new Contiene;
                $contiene24->idProducto = $producto8->id;
                $contiene24->idInsumo = $insumo22->id;
                $contiene24->cantidad = 1;
                $contiene24->idEmpresa = $empresa->id;
                $contiene24->save();

                $contiene25 = new Contiene;
                $contiene25->idProducto = $producto9->id;
                $contiene25->idInsumo = $insumo10->id;
                $contiene25->cantidad = 1.7;
                $contiene25->idEmpresa = $empresa->id;
                $contiene25->save();

                $contiene26 = new Contiene;
                $contiene26->idProducto = $producto9->id;
                $contiene26->idInsumo = $insumo23->id;
                $contiene26->cantidad = 4;
                $contiene26->idEmpresa = $empresa->id;
                $contiene26->save();

                $contiene27 = new Contiene;
                $contiene27->idProducto = $producto9->id;
                $contiene27->idInsumo = $insumo24->id;
                $contiene27->cantidad = 0.38;
                $contiene27->idEmpresa = $empresa->id;
                $contiene27->save();

                $contiene28 = new Contiene;
                $contiene28->idProducto = $producto10->id;
                $contiene28->idInsumo = $insumo10->id;
                $contiene28->cantidad = 1.5;
                $contiene28->idEmpresa = $empresa->id;
                $contiene28->save();

                $contiene29 = new Contiene;
                $contiene29->idProducto = $producto10->id;
                $contiene29->idInsumo = $insumo8->id;
                $contiene29->cantidad = 0.8;
                $contiene29->idEmpresa = $empresa->id;
                $contiene29->save();

                $contiene30 = new Contiene;
                $contiene30->idProducto = $producto10->id;
                $contiene30->idInsumo = $insumo25->id;
                $contiene30->cantidad = 0.5;
                $contiene30->idEmpresa = $empresa->id;
                $contiene30->save();

                $contiene31 = new Contiene;
                $contiene31->idProducto = $producto11->id;
                $contiene31->idInsumo = $insumo26->id;
                $contiene31->cantidad = 2;
                $contiene31->idEmpresa = $empresa->id;
                $contiene31->save();

                $contiene32 = new Contiene;
                $contiene32->idProducto = $producto11->id;
                $contiene32->idInsumo = $insumo27->id;
                $contiene32->cantidad = 0.38;
                $contiene32->idEmpresa = $empresa->id;
                $contiene32->save();

                $contiene33 = new Contiene;
                $contiene33->idProducto = $producto12->id;
                $contiene33->idInsumo = $insumo28->id;
                $contiene33->cantidad = 1.2;
                $contiene33->idEmpresa = $empresa->id;
                $contiene33->save();

                $contiene34 = new Contiene;
                $contiene34->idProducto = $producto12->id;
                $contiene34->idInsumo = $insumo29->id;
                $contiene34->cantidad = 1.2;
                $contiene34->idEmpresa = $empresa->id;
                $contiene34->save();

                $contiene35 = new Contiene;
                $contiene35->idProducto = $producto13->id;
                $contiene35->idInsumo = $insumo32->id;
                $contiene35->cantidad = 0.5;
                $contiene35->idEmpresa = $empresa->id;
                $contiene35->save();

                $contiene36 = new Contiene;
                $contiene36->idProducto = $producto13->id;
                $contiene36->idInsumo = $insumo14->id;
                $contiene36->cantidad = 0.5;
                $contiene36->idEmpresa = $empresa->id;
                $contiene36->save();

                $contiene37 = new Contiene;
                $contiene37->idProducto = $producto13->id;
                $contiene37->idInsumo = $insumo10->id;
                $contiene37->cantidad = 0.5;
                $contiene37->idEmpresa = $empresa->id;
                $contiene37->save();

                $contiene38 = new Contiene;
                $contiene38->idProducto = $producto13->id;
                $contiene38->idInsumo = $insumo12->id;
                $contiene38->cantidad = 0.5;
                $contiene38->idEmpresa = $empresa->id;
                $contiene38->save();

                $contiene39 = new Contiene;
                $contiene39->idProducto = $producto13->id;
                $contiene39->idInsumo = $insumo26->id;
                $contiene39->cantidad = 0.5;
                $contiene39->idEmpresa = $empresa->id;
                $contiene39->save();

                $contiene40 = new Contiene;
                $contiene40->idProducto = $producto13->id;
                $contiene40->idInsumo = $insumo13->id;
                $contiene40->cantidad = 0.8;
                $contiene40->idEmpresa = $empresa->id;
                $contiene40->save();

                $contiene41 = new Contiene;
                $contiene41->idProducto = $producto13->id;
                $contiene41->idInsumo = $insumo31->id;
                $contiene41->cantidad = 1;
                $contiene41->idEmpresa = $empresa->id;
                $contiene41->save();

                $contiene42 = new Contiene;
                $contiene42->idProducto = $producto14->id;
                $contiene42->idInsumo = $insumo10->id;
                $contiene42->cantidad = 1.35;
                $contiene42->idEmpresa = $empresa->id;
                $contiene42->save();

                $contiene43 = new Contiene;
                $contiene43->idProducto = $producto14->id;
                $contiene43->idInsumo = $insumo33->id;
                $contiene43->cantidad = 0.6;
                $contiene43->idEmpresa = $empresa->id;
                $contiene43->save();

                $contiene44 = new Contiene;
                $contiene44->idProducto = $producto14->id;
                $contiene44->idInsumo = $insumo34->id;
                $contiene44->cantidad = 0.5;
                $contiene44->idEmpresa = $empresa->id;
                $contiene44->save();

                $contiene45 = new Contiene;
                $contiene45->idProducto = $producto14->id;
                $contiene45->idInsumo = $insumo31->id;
                $contiene45->cantidad = 0.5;
                $contiene45->idEmpresa = $empresa->id;
                $contiene45->save();

                $contiene46 = new Contiene;
                $contiene46->idProducto = $producto14->id;
                $contiene46->idInsumo = $insumo8->id;
                $contiene46->cantidad = 0.17;
                $contiene46->idEmpresa = $empresa->id;
                $contiene46->save();

                $contiene47 = new Contiene;
                $contiene47->idProducto = $producto14->id;
                $contiene47->idInsumo = $insumo9->id;
                $contiene47->cantidad = 17;
                $contiene47->idEmpresa = $empresa->id;
                $contiene47->save();

                $contiene48 = new Contiene;
                $contiene48->idProducto = $producto15->id;
                $contiene48->idInsumo = $insumo35->id;
                $contiene48->cantidad = 1.7;
                $contiene48->idEmpresa = $empresa->id;
                $contiene48->save();

                $contiene49 = new Contiene;
                $contiene49->idProducto = $producto15->id;
                $contiene49->idInsumo = $insumo36->id;
                $contiene49->cantidad = 0.6;
                $contiene49->idEmpresa = $empresa->id;
                $contiene49->save();

                $contiene50 = new Contiene;
                $contiene50->idProducto = $producto16->id;
                $contiene50->idInsumo = $insumo32->id;
                $contiene50->cantidad = 1.2;
                $contiene50->idEmpresa = $empresa->id;
                $contiene50->save();

                $contiene51 = new Contiene;
                $contiene51->idProducto = $producto16->id;
                $contiene51->idInsumo = $insumo21->id;
                $contiene51->cantidad = 0.6;
                $contiene51->idEmpresa = $empresa->id;
                $contiene51->save();

                $contiene52 = new Contiene;
                $contiene52->idProducto = $producto16->id;
                $contiene52->idInsumo = $insumo8->id;
                $contiene52->cantidad = 0.5;
                $contiene52->idEmpresa = $empresa->id;
                $contiene52->save();

                $contiene53 = new Contiene;
                $contiene53->idProducto = $producto17->id;
                $contiene53->idInsumo = $insumo10->id;
                $contiene53->cantidad = 1.35;
                $contiene53->idEmpresa = $empresa->id;
                $contiene53->save();

                $contiene54 = new Contiene;
                $contiene54->idProducto = $producto17->id;
                $contiene54->idInsumo = $insumo24->id;
                $contiene54->cantidad = 1;
                $contiene54->idEmpresa = $empresa->id;
                $contiene54->save();

                $contiene55 = new Contiene;
                $contiene55->idProducto = $producto17->id;
                $contiene55->idInsumo = $insumo37->id;
                $contiene55->cantidad = 2;
                $contiene55->idEmpresa = $empresa->id;
                $contiene55->save();

                $contiene56 = new Contiene;
                $contiene56->idProducto = $producto18->id;
                $contiene56->idInsumo = $insumo26->id;
                $contiene56->cantidad = 1;
                $contiene56->idEmpresa = $empresa->id;
                $contiene56->save();

                $contiene57 = new Contiene;
                $contiene57->idProducto = $producto18->id;
                $contiene57->idInsumo = $insumo38->id;
                $contiene57->cantidad = 1;
                $contiene57->idEmpresa = $empresa->id;
                $contiene57->save();

                $contiene58 = new Contiene;
                $contiene58->idProducto = $producto18->id;
                $contiene58->idInsumo = $insumo36->id;
                $contiene58->cantidad = 1;
                $contiene58->idEmpresa = $empresa->id;
                $contiene58->save();

                $contiene59 = new Contiene;
                $contiene59->idProducto = $producto19->id;
                $contiene59->idInsumo = $insumo35->id;
                $contiene59->cantidad = 1.5;
                $contiene59->idEmpresa = $empresa->id;
                $contiene59->save();

                $contiene60 = new Contiene;
                $contiene60->idProducto = $producto20->id;
                $contiene60->idInsumo = $insumo26->id;
                $contiene60->cantidad = 1.2;
                $contiene60->idEmpresa = $empresa->id;
                $contiene60->save();

                $contiene61 = new Contiene;
                $contiene61->idProducto = $producto20->id;
                $contiene61->idInsumo = $insumo1->id;
                $contiene61->cantidad = 0.6;
                $contiene61->idEmpresa = $empresa->id;
                $contiene61->save();

                $contiene62 = new Contiene;
                $contiene62->idProducto = $producto20->id;
                $contiene62->idInsumo = $insumo39->id;
                $contiene62->cantidad = 0.5;
                $contiene62->idEmpresa = $empresa->id;
                $contiene62->save();

                $contiene63 = new Contiene;
                $contiene63->idProducto = $producto21->id;
                $contiene63->idInsumo = $insumo40->id;
                $contiene63->cantidad = 1;
                $contiene63->idEmpresa = $empresa->id;
                $contiene63->save();

                $contiene64 = new Contiene;
                $contiene64->idProducto = $producto21->id;
                $contiene64->idInsumo = $insumo41->id;
                $contiene64->cantidad = 3;
                $contiene64->idEmpresa = $empresa->id;
                $contiene64->save();

                $contiene65 = new Contiene;
                $contiene65->idProducto = $producto21->id;
                $contiene65->idInsumo = $insumo10->id;
                $contiene65->cantidad = 1;
                $contiene65->idEmpresa = $empresa->id;
                $contiene65->save();

                $contiene66 = new Contiene;
                $contiene66->idProducto = $producto22->id;
                $contiene66->idInsumo = $insumo14->id;
                $contiene66->cantidad = 1.7;
                $contiene66->idEmpresa = $empresa->id;
                $contiene66->save();

                $contiene67 = new Contiene;
                $contiene67->idProducto = $producto22->id;
                $contiene67->idInsumo = $insumo30->id;
                $contiene67->cantidad = 3.4;
                $contiene67->idEmpresa = $empresa->id;
                $contiene67->save();

                $contiene68 = new Contiene;
                $contiene68->idProducto = $producto23->id;
                $contiene68->idInsumo = $insumo14->id;
                $contiene68->cantidad = 1.35;
                $contiene68->idEmpresa = $empresa->id;
                $contiene68->save();

                $contiene69 = new Contiene;
                $contiene69->idProducto = $producto23->id;
                $contiene69->idInsumo = $insumo42->id;
                $contiene69->cantidad = 0.6;
                $contiene69->idEmpresa = $empresa->id;
                $contiene69->save();

                $contiene70 = new Contiene;
                $contiene70->idProducto = $producto23->id;
                $contiene70->idInsumo = $insumo43->id;
                $contiene70->cantidad = 1.35;
                $contiene70->idEmpresa = $empresa->id;
                $contiene70->save();

                $contiene71 = new Contiene;
                $contiene71->idProducto = $producto23->id;
                $contiene71->idInsumo = $insumo39->id;
                $contiene71->cantidad = 1.35;
                $contiene71->idEmpresa = $empresa->id;
                $contiene71->save();

                $contiene72 = new Contiene;
                $contiene72->idProducto = $producto24->id;
                $contiene72->idInsumo = $insumo32->id;
                $contiene72->cantidad = 1.5;
                $contiene72->idEmpresa = $empresa->id;
                $contiene72->save();

                $contiene73 = new Contiene;
                $contiene73->idProducto = $producto24->id;
                $contiene73->idInsumo = $insumo39->id;
                $contiene73->cantidad = 3;
                $contiene73->idEmpresa = $empresa->id;
                $contiene73->save();

                $contiene74 = new Contiene;
                $contiene74->idProducto = $producto24->id;
                $contiene74->idInsumo = $insumo9->id;
                $contiene74->cantidad = 0.5;
                $contiene74->idEmpresa = $empresa->id;
                $contiene74->save();

                $contiene75 = new Contiene;
                $contiene75->idProducto = $producto25->id;
                $contiene75->idInsumo = $insumo44->id;
                $contiene75->cantidad = 2;
                $contiene75->idEmpresa = $empresa->id;
                $contiene75->save();

                $contiene76 = new Contiene;
                $contiene76->idProducto = $producto25->id;
                $contiene76->idInsumo = $insumo45->id;
                $contiene76->cantidad = 1;
                $contiene76->idEmpresa = $empresa->id;
                $contiene76->save();

                $contiene77 = new Contiene;
                $contiene77->idProducto = $producto25->id;
                $contiene77->idInsumo = $insumo39->id;
                $contiene77->cantidad = 1;
                $contiene77->idEmpresa = $empresa->id;
                $contiene77->save();

                $contiene72 = new Contiene;
                $contiene72->idProducto = $producto25->id;
                $contiene72->idInsumo = $insumo40->id;
                $contiene72->cantidad = 2;
                $contiene72->idEmpresa = $empresa->id;
                $contiene72->save();
            }

            if ($empresa->baroRestaurante == "restaurante" || $empresa->baroRestaurante == "barRestaurante") {
                //CATEGORIAS RESTAURANTE
                $categoria11 = new Categoria;
                $categoria11->nombre = "Carnes";
                $categoria11->idEmpresa = $empresa->id;
                $categoria11->imagen = "carnes.png";
                $categoria11->save();

                $categoria12 = new Categoria;
                $categoria12->nombre = "Hamburguesas";
                $categoria12->idEmpresa = $empresa->id;
                $categoria12->imagen = "hamburguesas.png";
                $categoria12->save();

                $categoria13 = new Categoria;
                $categoria13->nombre = "Perros";
                $categoria13->idEmpresa = $empresa->id;
                $categoria13->imagen = "perros.png";
                $categoria13->save();

                $categoria14 = new Categoria;
                $categoria14->nombre = "Sandwiches";
                $categoria14->idEmpresa = $empresa->id;
                $categoria14->imagen = "sandwiches.png";
                $categoria14->save();

                $categoria15 = new Categoria;
                $categoria15->nombre = "Pizzas";
                $categoria15->idEmpresa = $empresa->id;
                $categoria15->imagen = "pizzas.png";
                $categoria15->save();

                $categoria16 = new Categoria;
                $categoria16->nombre = "Mariscos";
                $categoria16->idEmpresa = $empresa->id;
                $categoria16->imagen = "mariscos.png";
                $categoria16->save();

                $categoria17 = new Categoria;
                $categoria17->nombre = "Pastas";
                $categoria17->idEmpresa = $empresa->id;
                $categoria17->imagen = "pastas.png";
                $categoria17->save();

                $categoria18 = new Categoria;
                $categoria18->nombre = "Desgranados";
                $categoria18->idEmpresa = $empresa->id;
                $categoria18->imagen = "desgranados.png";
                $categoria18->save();

                //INSUMOS RESTAURANTE
                $insumo46 = new Insumo;
                $insumo46->idProveedor = $proveedor->id;
                $insumo46->nombre = "Carne de res";
                $insumo46->medida = 0;
                $insumo46->idEmpresa = $empresa->id;
                $insumo46->save();

                $insumo47 = new Insumo;
                $insumo47->idProveedor = $proveedor->id;
                $insumo47->nombre = "Champiñones";
                $insumo47->medida = 0;
                $insumo47->idEmpresa = $empresa->id;
                $insumo47->save();

                $insumo48 = new Insumo;
                $insumo48->idProveedor = $proveedor->id;
                $insumo48->nombre = "Aceite de oliva";
                $insumo48->medida = 0;
                $insumo48->idEmpresa = $empresa->id;
                $insumo48->save();

                $insumo49 = new Insumo;
                $insumo49->idProveedor = $proveedor->id;
                $insumo49->nombre = "Harina";
                $insumo49->medida = 0;
                $insumo49->idEmpresa = $empresa->id;
                $insumo49->save();

                $insumo50 = new Insumo;
                $insumo50->idProveedor = $proveedor->id;
                $insumo50->nombre = "Consomé de pollo en polvo";
                $insumo50->medida = 0;
                $insumo50->idEmpresa = $empresa->id;
                $insumo50->save();

                $insumo51 = new Insumo;
                $insumo51->idProveedor = $proveedor->id;
                $insumo51->nombre = "Tocino";
                $insumo51->medida = 0;
                $insumo51->idEmpresa = $empresa->id;
                $insumo51->save();

                //PRODUCTOS RESTAURANTE
                $producto25 = new Producto;
                $producto25->nombre = "Filet miñog";
                $producto25->descripcion = "Preparación: 10min > Cocción: 10min > Tiempo extra: 15min > Reposando > Listo en: 35min\n\n6 medallones de res gruesos de 175 gramos cada uno\nSal y pimienta al gusto\n6 rebanadas de tocino\n250 gramos de champiñones, rebanados\n4 cucharadas de aceite de oliva\n4 cucharadas de harina\n1 cucharada de consomé de pollo en polvo\n1 taza de agua";
                $producto25->receta = "1. Salpimienta los filetes y enrolla cada uno con 1 rebanada de tocino alrededor de la carne. Asegura el tocino con palillos y deja reposar durante 15 minutos.\n2. Mientras, calienta 3 cucharadas de aceite en un sartén grande a fuego medio y saltea los champiñones.\n3. Aparte, calienta 1 cucharada de aceite en una cacerola chica a fuego medio, agrega la harina y deja que se dore. Disuelve el consomé de pollo en el agua hirviendo y vierte sobre la harina. Agrega los champiñones salteados, reduce el fuego a bajo y cocina hasta que la salsa haya espesado.\n 4.Asa los filetes en la plancha caliente hasta lograr el término deseado y báñalos con la salsa al momento de servir";
                $producto25->imagen = "";
                $producto25->vaso = "Porciones: 6";
                $producto25->idCategoria = $categoria5->id;
                $producto25->idEmpresa = $empresa->id;
                $producto25->save();

                //CONTIENE RESTAURANTE
                $contiene73 = new Contiene;
                $contiene73->idProducto = $producto25->id;
                $contiene73->idInsumo = $insumo46->id;
                $contiene73->cantidad = 1050;
                $contiene73->idEmpresa = $empresa->id;
                $contiene73->save();

                $contiene74 = new Contiene;
                $contiene74->idProducto = $producto25->id;
                $contiene74->idInsumo = $insumo47->id;
                $contiene74->cantidad = 250;
                $contiene74->idEmpresa = $empresa->id;
                $contiene74->save();

                $contiene75 = new Contiene;
                $contiene75->idProducto = $producto25->id;
                $contiene75->idInsumo = $insumo48->id;
                $contiene75->cantidad = 4;
                $contiene75->idEmpresa = $empresa->id;
                $contiene75->save();

                $contiene76 = new Contiene;
                $contiene76->idProducto = $producto25->id;
                $contiene76->idInsumo = $insumo49->id;
                $contiene76->cantidad = 4;
                $contiene76->idEmpresa = $empresa->id;
                $contiene76->save();

                $contiene77 = new Contiene;
                $contiene77->idProducto = $producto25->id;
                $contiene77->idInsumo = $insumo50->id;
                $contiene77->cantidad = 1;
                $contiene77->idEmpresa = $empresa->id;
                $contiene77->save();

                $contiene78 = new Contiene;
                $contiene78->idProducto = $producto25->id;
                $contiene78->idInsumo = $insumo51->id;
                $contiene78->cantidad = 6;
                $contiene78->idEmpresa = $empresa->id;
                $contiene78->save();
            }
    }
}
